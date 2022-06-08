<?php
namespace ProviderProfile\Controllers;
use ProviderProfile\Models\UserModel;
use \App\Controllers\BaseController;

class PasswordController extends BaseController
{

	public function __construct()
	{
		$this->config = config('ProviderProfile');
		$this->data['config'] = $this->config;
	}

	public function forgotPassword()
	{
		if ($this->session->isProviderLoggedIn) {
			return redirect()->to('service-providers/dashboard');
		}
		$this->data['title'] = 'Forgot Password';
		return view($this->config->views['forgot-password'], $this->data);
	}

    //--------------------------------------------------------------------

	public function attemptForgotPassword()
	{
		$rules = [
			'email' => 'required|valid_email',
		];
		$errors = [
			'email' => [
				'required' => 'Email is required.',
				'valid_email' => 'Enter a valid email.',
			],
		];
		if (! $this->validate($rules, $errors)) {
			return redirect()->back()->withInput();
		}

		// check if email exists in DB
		$users = new UserModel();
		$data = $users->where(['email' => $this->request->getPost('email'), 'group_id' => 2])->first();
		if (! $data) {
            return redirect()->back()->with('email-error', lang('Profile.wrongEmail'));
        }

        // check if email is already sent to prevent spam
        if (! empty($data['reset_expires']) && $data['reset_expires'] >= time()) {
			return redirect()->back()->with('email-error', lang('Profile.emailAlreadySent'));
        }

		// set reset hash and expiration
        helper('providerprofile');
		$updatedUser['id'] = $data['id'];
		$updatedUser['reset_hash'] = random_string('alnum', 32);
		$updatedUser['reset_expires'] = time() + (MINUTE * 30);
		$users->save($updatedUser);
		// send password reset e-mail
        send_provider_password_reset_email($this->request->getPost('email'), site_url('service-providers/reset-password?token=').$updatedUser['reset_hash']);

        return redirect()->back()->with('success', lang('Profile.forgottenPasswordEmail'));
	}


    //--------------------------------------------------------------------
	public function resetPassword()
	{
		// check reset hash and expiration
		$users = new UserModel();
		$data = $users->where(['reset_hash' => $this->request->getGet('token'), 'group_id' => 2])
			->where('reset_expires >', time())
			->first();

		if (!$data) {
            return redirect()->to('service-providers')->with('error', lang('Profile.invalidRequest'));
        }
        $this->data['title'] = 'Reset Password';

		return view($this->config->views['reset-password'], $this->data);
	}

    //--------------------------------------------------------------------
	public function attemptResetPassword()
	{		// validate request
		$rules = [
			'token' => ['label' => 'Token', 'rules' => 'required'],
			'password' => ['label' => 'Password', 'rules' => 'required|passwordValidation[password]'],
			'password_confirm' => ['label' => 'Confirm Password', 'rules' => 'matches[password]'],
		];
		$errors = [
			'token' => [
				'required' => 'TOken is required.'
			],
			'password' => [
				'required' => 'Password is required.',
				'passwordValidation' => 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.',
			],
			'password_confirm' => [
				'matches' => 'Confirm Password field does not match the Password field.'
			],
		];
		if (! $this->validate($rules, $errors)) {
            return redirect()->back()->withInput();
        }

		// check reset hash, expiration
		$users = new UserModel();
		$data = $users->where(['reset_hash' => $this->request->getPost('token'), 'group_id' => 2])
			->where('reset_expires >', time())
			->first();

		if (!$data) {
            return redirect()->to('service-providers')->with('error', lang('Profile.invalidRequest'));
        }

		// update user password
        $updatedUsers['id'] = $data['id'];
        $updatedUsers['password_hash'] =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $updatedUsers['reset_hash'] = null;
        $updatedUsers['reset_expires'] = null;
        $users->save($updatedUsers);

		// redirect to login
        return redirect()->to('service-providers')->with('success', lang('Profile.passwordUpdateSuccess'));
	}

}
