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
			return view($this->config->views['plans'], $this->data);
		}
	}
}
