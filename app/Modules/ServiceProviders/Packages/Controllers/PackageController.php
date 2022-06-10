<?php
namespace ProviderPackage\Controllers;
use \App\Controllers\BaseController;


class PackageController extends BaseController
{

	public function __construct()
	{
		// load auth settings
		$this->config = config('ProviderPackage');
		$this->data['config'] = $this->config;
	}

	public function index()
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax()) { 
			$this->data['title'] = 'Select Plan';
			$this->data['plans'] = $this->crud->select('plans', '', ['is_deleted' => 2], 'id DESC');
			$currentPlan = $this->crud->select('provider_plans', 'plan_id, plan_rate', ['user_id' => $this->session->providerData['id']], '', TRUE);
			if (!empty($currentPlan)) {
				$this->data['currentPlan'] = $currentPlan;
			}
			return view($this->config->views['plans'], $this->data);
		}
	}
}
