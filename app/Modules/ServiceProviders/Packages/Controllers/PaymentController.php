<?php
namespace ProviderPackage\Controllers;
use \App\Controllers\BaseController;


class PaymentController extends BaseController
{

	public function __construct()
	{
		// load auth settings
		$this->config = config('ProviderPackage');
		$this->data['config'] = $this->config;
		$this->data['success'] = false;
		$this->data['hash'] = csrf_hash();
	}

	public function index($id = '')
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax()) {
			if ($id && is_numeric($id = decrypt($id))) {
				$this->data['details'] = $details = $this->crud->select('plans', 'id, plan_name, number_of_client, storage_capacity, plan_rate', ['id' => $id] , '', TRUE);
				if (!empty($details)) {
					$this->data['title'] = 'Checkout';
					return view($this->config->views['plans-checkout'], $this->data);
				} else {
					$this->session->setFlashdata('message', 'Something went wrong!');
					$this->session->setFlashdata('message_type', 'error');
					return redirect()->to('service-providers/packages');
				}	
				
			} else {
				$this->session->setFlashdata('message', 'Something went wrong!');
				$this->session->setFlashdata('message_type', 'error');
				return redirect()->to('service-providers/packages');
			} 
		}
	}

	public function attemptCheckout()
	{
		if ($this->request->isAjax() && $this->request->getMethod() == 'post') {
			$id = decrypt($this->request->getPost('plan_id'));
			$details = $this->crud->select('plans', 'id, plan_name, number_of_client, storage_capacity, plan_rate', ['id' => $id] , '', TRUE);
			$data = array(
				'payment_via' => $this->request->getPost('via'),
				'user_id' => $this->session->providerData['id'],
				'plan_id' => $details->id,
				'valid_from' => strtotime('now'),
				'valid_to' => strtotime('now') + YEAR,
				'plan_rate' => $details->plan_rate,
				'plan_storage' => $details->storage_capacity,
				'added_by' => $this->session->providerData['id'],
				'created_at' => strtotime('now'),
			);
			if ($lastId = $this->crud->add('provider_plans', $data)) {
				$this->data['success'] = true;
				$this->data['message'] = 'Package has been successfully activated';
				echo json_encode($this->data); die;
			}
		}else {
			$this->data['message'] = 'Something went wrong';
			error($this->data);
		}
	}
}
