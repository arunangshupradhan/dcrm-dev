<?php
namespace AdminProfile\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use AdminProfile\Models\UserModel;

class PasswordController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('AdminProfile');
	}

    //--------------------------------------------------------------------
	public function forgotPassword()
	{
		if ($this->session->isLoggedIn) {
			return redirect()->to('/admin/dashboard');
		}
		return view($this->config->views['admin-forgot-password'], ['config' => $this->config]);
	}

    //--------------------------------------------------------------------

	public function attemptForgotPassword()
	{
		// validate request
		if (! $this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }
		// check if email exists in DB
		$users = new UserModel();
		$data = $users->where('email', $this->request->getPost('email'))->first();
		if (! $data) {
            return redirect()->back()->with('error', lang('Auth.wrongEmail'));
        }

        // check if email is already sent to prevent spam
        if (! empty($data['reset_expires']) && $data['reset_expires'] >= time()) {
			return redirect()->back()->with('error', lang('Auth.emailAlreadySent'));
        }

		// set reset hash and expiration
		helper(['text', 'profile']);
		$updatedUser['id'] = $data['id'];
		$updatedUser['reset_hash'] = random_string('alnum', 32);
		$updatedUser['reset_expires'] = time() + (MINUTE * 30);
		$users->save($updatedUser);
		// send password reset e-mail
        send_password_reset_email($this->request->getPost('email'), site_url('admin/reset-password?token=').$updatedUser['reset_hash']);

        return redirect()->back()->with('success', lang('Auth.forgottenPasswordEmail'));
	}


    //--------------------------------------------------------------------
	public function resetPassword()
	{
		// check reset hash and expiration
		$users = new UserModel();
		$data = $users->where('reset_hash', $this->request->getGet('token'))
			->where('reset_expires >', time())
			->first();

		if (!$data) {
            return redirect()->to('admin')->with('error', lang('Auth.invalidRequest'));
        }

		return view($this->config->views['admin-reset-password'], ['config' => $this->config]);
	}

    //--------------------------------------------------------------------
	public function attemptResetPassword()
	{
		// validate request
		$rules = [
			'token' => ['label' => 'Token', 'rules' => 'required'],
			'password' => ['label' => 'Password', 'rules' => 'required|passwordValidation[password]'],
			'password_confirm' => ['label' => 'Confirm Password', 'rules' => 'matches[password]'],
		];
		$errors = [
			'password' => [
				'required' => 'Password is required.',
				'passwordValidation' => 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.',
			]
		];
		if (! $this->validate($rules, $errors)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

		// check reset hash, expiration
		$users = new UserModel();
		$data = $users->where('reset_hash', $this->request->getPost('token'))
			->where('reset_expires >', time())
			->first();

		if (!$data) {
            return redirect()->to('admin')->with('error', lang('Auth.invalidRequest'));
        }

		// update user password
        $updatedUsers['id'] = $data['id'];
        $updatedUsers['password_hash'] =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $updatedUsers['reset_hash'] = null;
        $updatedUsers['reset_expires'] = null;
        $users->save($updatedUsers);

		// redirect to login
        return redirect()->to('admin')->with('success', lang('Auth.passwordUpdateSuccess'));
	}

}
