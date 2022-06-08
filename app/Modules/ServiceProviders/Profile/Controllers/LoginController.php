<?php
namespace ProviderProfile\Controllers;
use ProviderProfile\Models\UserModel;
use ProviderProfile\Models\SessionLogModel;
use \App\Controllers\BaseController;


class LoginController extends BaseController
{

	public function __construct()
	{
		$this->config = config('ProviderProfile');
	}

    //--------------------------------------------------------------------

	/**
	 * Displays login form or redirects if user is already logged in.
	 */
	public function login()
	{	
		if ($this->session->isProviderLoggedIn) {
			if ($this->session->providerData['group_id'] == 2) {
				return redirect()->to('service-providers/dashboard');
			}
		}
		$this->data['title'] = 'Login';
		$this->data['config'] = $this->config;
		return view($this->config->views['providers-login'], $this->data);
	}
    //--------------------------------------------------------------------

	/**
	 * Attempts to verify user's credentials through POST request.
	 */
	public function attemptLogin()
	{
		$agent = $this->request->getUserAgent();

		$rules = [
			'email'		=> 'required',
			'password' 	=> 'required|min_length[8]',
		];

		if (! $this->validate($rules)) {
			return redirect()->to('service-providers')
			->withInput();
		}
		// check credentials
		$users = new UserModel();
		$user = $users->where( ['email' => $this->request->getPost('email'), 'group_id' => 2])->first();
		// $user || $user = $users->where('mobile', $this->request->getPost('email'))->first();
		if (is_null($user) || !password_verify($this->request->getPost('password'), $user['password_hash'])) 
		{
			return redirect()->to('service-providers')->withInput()->with('error', lang('Profile.wrongCredentials'));
		}

		// check activation
		if (!$user['active'] || !$user['is_deleted']) {
			return redirect()->to('service-providers')->withInput()->with('error', lang('Profile.notActivated'));
		}

		$agentData = array(
			'browser' => $this->currentAgent($agent),
			'platform' => $agent->getPlatform(),
			'ip' => $this->request->getIPAddress(),
			'user_id' => $user['id'],
			'session_start' => date("Y-m-d g:i a")
		);
		$logM = new SessionLogModel();

        // Add operation
        $sessionID = $logM->insert_data($agentData);

		// login OK, save user data to session
		$this->session->set('isProviderLoggedIn', true);
		$this->session->set('providerData', [
			'id' 			=> $user['id'],
			'group_id' 		=> $user['group_id'],
			'sessionId'     => $sessionID,
		]);

		return redirect()->to('service-providers/dashboard');
	}

    //--------------------------------------------------------------------

	/**
	 * Log the user out.
	 */
	public function logout()
	{
		if ($this->session->isProviderLoggedIn) {
			$agentData = array(
				'session_end' => date("Y-m-d g:i a")
			);
			$logM = new SessionLogModel();
			$logM->update_data($this->session->providerData['sessionId'], $agentData);
			$this->session->remove(['isProviderLoggedIn', 'providerData']);
		}
		
		return redirect()->to('service-providers');
	}



	// AGENT
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
