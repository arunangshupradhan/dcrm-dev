<?php
namespace ProviderProfile\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use ProviderProfile\Models\UserModel;
use ProviderProfile\Models\SessionLogModel;
use \App\Controllers\BaseController;


class RegistrationController extends BaseController
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

		// load auth settings
		$this->config = config('ProviderProfile');
	}

    //--------------------------------------------------------------------

	/**
	 * Displays register form.
	 */
	public function signUp()
	{
		if ($this->session->isProviderLoggedIn) {
			return redirect()->to('service-providers');
		}

		$this->data['title'] = 'Sign Up';
		$this->data['config'] = $this->config;
		$this->data['captchaCode'] =  $captchaCode = randomString(6);
		$this->session->set('captcha', $captchaCode);

		return view($this->config->views['sign-up'], $this->data);
	}

	public function attemptRegister()
	{
		$rules = [
			'name' 				=> 'required|min_length[2]',
			'username' 			=> 'required|is_unique[users.user_name]',
			'email' 			=> 'required|valid_email|is_unique[users.email]',
			'password'			=> 'required|passwordValidation[password]|min_length[5]',
			'captcha'			=> 'required|validateCaptcha[captcha]',
		];
		$errors = [
			'name' => [
				'required' => 'Name is required.',
				'min_length' => 'Name should be atleast 2 characters in length.'
			],
			'username' => [
				'required' => 'Username is required.',
				'is_unique' => 'Duplicate username found.',
			],
			'email' => [
				'required' => 'Email is required.',
				'valid_email' => 'Enter a valid email.',
				'is_unique' => 'Duplicate email id found.',
			],
			'password' => [
				'required' => 'Password is required.',
				'passwordValidation' => 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.',
			],
			'captcha' => [
				'required' => 'Captcha is required.',
				'validateCaptcha' => 'Invalid captcha code.',
			]
		];
		if (! $this->validate($rules, $errors)) {
            return redirect()->back()->withInput();
        }
		$users = new UserModel();

        $user = [
        	'group_id' => 2,
            'name'          	=> $this->request->getPost('name'),
            'user_name' 		=> $this->request->getPost('username'),
            'email'         	=> $this->request->getPost('email'),
            'password_hash'		=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'activate_hash' 	=> random_string('alnum', 32)
        ];

        if (!$users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }
		helper('providerprofile');
		send_provider_activation_email($user['email'], $user['activate_hash']);
		// success
        return redirect()->to('service-providers')->with('success', lang('Profile.registrationSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Activate account.
	 */
	public function activateAccount()
	{
		$users = new UserModel();
		$logM = new SessionLogModel();
		$agent = $this->request->getUserAgent();
		// check token
		$user = $users->where(['activate_hash' => $this->request->getGet('token'), 'group_id' => 2])
			->where('active', 0)
			->first();

		if (is_null($user)) {
			return redirect()->to('service-providers')->with('error', lang('Profile.activationNoUser'));
		}

		// update user account to active
		$updatedUser['id'] = $user['id'];
		$updatedUser['activate_hash'] = null;
		$updatedUser['active'] = 1;
		$users->save($updatedUser);

		$agentData = array(
			'browser' => $this->currentAgent($agent),
			'platform' => $agent->getPlatform(),
			'ip' => $this->request->getIPAddress(),
			'user_id' => $user['id'],
			'session_start' => date("Y-m-d g:i a")
		);

        // Add operation
		$sessionID = $logM->insert_data($agentData);

		// login OK, save user data to session
		$this->session->set('isProviderLoggedIn', true);
		$this->session->set('providerData', [
			'id' 			=> $user['id'],
			'group_id' 		=> $user['group_id'],
			'sessionId'     => $sessionID,
		]);

		return redirect()->to('service-providers/packages')->with('success', lang('Profile.activationSuccess'));
	}


	private function currentAgent($agent)
	{
		if ($agent->isBrowser()) {
			$currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
		} elseif ($agent->isRobot()) {
			$currentAgent = $agent->getRobot();
		} elseif ($agent->isMobile()) {
			$currentAgent = $agent->getMobile();
		} else {
			$currentAgent = 'Unidentified User Agent';
		}	
		return $currentAgent;
	}

}
