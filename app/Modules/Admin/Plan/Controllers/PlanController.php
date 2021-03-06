<?php
namespace AdminPlan\Controllers;

// use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use \App\Controllers\BaseController;


class PlanController extends BaseController
{

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('AdminPlan');
		$this->data['config'] = $this->config;
	}

	public function index()
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax()) { 
			$this->data['title'] = 'Our Existing Plans';
			$this->data['plans'] = $this->crud->select('plans', '', ['is_deleted' => 2], 'id DESC');
			return view($this->config->views['plans'], $this->data);
		}
	}

	public function addPlan($id = 0)
	{
		if (($this->request->getMethod() == "post") && $this->request->isAjax()) { 
			$data = $this->request->getPost();
			$this->data['success'] = false;
			$this->data['hash'] = csrf_hash();
			if (strlen(trim($data['plan_name'])) == 0) {
				$this->data['id'] = '#plan_name';
				$this->data['message'] = 'Enter plan name.';
				error($this->data);
			} else if (is_duplicate('plans', 'id', ['plan_name' => trim($data['plan_name']), 'id<>' => $id])) {
				$this->data['id'] = '#plan_name';
				$this->data['message'] = 'Duplicate plan name found.';
				error($this->data);
			}
			if (strlen(trim($data['number_of_client'])) == 0) {
				$this->data['id'] = '#number_of_client';
				$this->data['message'] = 'Enter number of client.';
				error($this->data);
			}
			if (strlen(trim($data['storage_capacity'])) == 0) {
				$this->data['id'] = '#storage_capacity';
				$this->data['message'] = 'Enter storage capacity.';
				error($this->data);
			}
			if (strlen(trim($data['plan_rate'])) == 0 && $data['plan_rate'] < 0) {
				$this->data['id'] = '#plan_rate';
				$this->data['message'] = 'Enter a valid plan rate.';
				error($this->data);
			}
			$dataArr = array(
				'plan_name' => trim($data['plan_name']),
				'plan_rate' => trim($data['plan_rate']),
				'number_of_client' => trim($data['number_of_client']),
				'storage_capacity' => sizeConverter(trim($data['storage_capacity']), 'MB'),
			);
			if (empty($id)) {
				$dataArr['created_at'] = strtotime('now');
				$dataArr['added_by'] = $this->session->userData['id'];
				if ($lastId = $this->crud->add('plans', $dataArr)) {
					$this->data['success'] = true;
					$this->data['message'] = 'Plan has been successfully created.';
					echo json_encode($this->data); die;
				}
			} else {
				$dataArr['updated_at'] = strtotime('now');
				$dataArr['last_updated_by'] = $this->session->userData['id'];
				if ($lastId = $this->crud->updateData('plans', ['id' => $id], $dataArr)) {
					$this->data['success'] = true;
					$this->data['message'] = 'Plan has been successfully updated.';
					echo json_encode($this->data); die;
				}
			}
		}
	}

	public function deletePlan($id = 0)
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax()) { 
			if (!empty($id) && is_numeric($id)) {
				if ($this->crud->updateData('plans', ['id' => $id], ['is_deleted' => 1])) {
					$this->session->setFlashdata('message', 'Plan has been successfully deleted');
					$this->session->setFlashdata('message_type', 'success');
					return redirect()->route('plan');
				}
			} else {
				$this->session->setFlashdata('message', 'Something went wrong!');
				$this->session->setFlashdata('message_type', 'error');
				return redirect()->route('plan');
			}
		}
	}

	public function ajaxGetPlan()
	{
		if (($this->request->getMethod() == "post") && $this->request->isAjax()) {
			$this->data['success'] = false;
			$this->data['hash'] = csrf_hash();
			$details = $this->crud->select('plans', '', ['id' => $this->request->getPost('id')], '', TRUE);
			if (!empty($details)) {
				$details->storage_capacity = sizeConverter($details->storage_capacity, 'GB');
				$this->data['details'] = $details;
				$this->data['success'] = true;
				echo json_encode($this->data); die;
			}
		} else {
			return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
		}

	}


}
