<?php
namespace ProviderDashboard\Controllers;

use CodeIgniter\Controller;
use \App\Controllers\BaseController;


class DashboardController extends BaseController
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
		$this->config = config('ProviderDashboard');
		$this->data['config'] = $this->config;
	}

    //--------------------------------------------------------------------

	/**
	 * Displays login form or redirects if user is already logged in.
	 */
	public function index()
	{
		$this->data['title'] = 'Service Providers Dashboard';
		return view($this->config->views['dashboard'], $this->data);
	}
}
