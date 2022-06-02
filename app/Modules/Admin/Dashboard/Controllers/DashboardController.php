<?php
namespace AdminDashboard\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;


class DashboardController extends Controller
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
		$this->config = config('AdminDashboard');
		if (!$this->session->isLoggedIn) {
			return redirect()->to('admin');			
		}

	}

    //--------------------------------------------------------------------

	/**
	 * Displays login form or redirects if user is already logged in.
	 */
	public function index()
	{
		$this->data['title'] = 'Admin Dashboard';
		$this->data['config'] = $this->config;
		return view($this->config->views['dashboard'], $this->data);
	}
}
