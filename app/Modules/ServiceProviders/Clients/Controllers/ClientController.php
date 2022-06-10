<?php
namespace ProviderClient\Controllers;
use \App\Controllers\BaseController;


class ClientController extends BaseController
{

	public function __construct()
	{
		$this->config = config('ProviderClient');
		$this->data['config'] = $this->config;
		$this->data['success'] = false;
		$this->data['hash'] = csrf_hash();
		$this->data['error'] = array();
	}

	public function index()
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax()) {
			$this->data['title'] = 'Clients';
			$this->data['lists'] = $this->crud->select('clients', '', ['is_deleted' => 2, 'provider_id' => $this->session->providerData['id']], 'id DESC');
			return view($this->config->views['client'], $this->data);
		}
	}

	public function addClient()
	{
		if (($this->request->getMethod() == "post") && $this->request->isAjax()) { 
			$data = $this->request->getPost();
			if (strlen(trim($data['name'])) == 0) {
				$this->data['error']['#name'] = 'Name is required.';
			}
			if (strlen(trim($data['email'])) == 0) {
				$this->data['error']['#email'] = 'Email is required.';
			} elseif (!isValidEmail(trim($data['email']))) {
				$this->data['error']['#email'] = 'Invalid email address.';
			} elseif (is_duplicate('clients', 'email', ['email' => trim($data['email'])])) {
				$this->data['error']['#email'] = 'Duplicate email address found.';
			}
			if (empty($data['country'])) {
				$this->data['error']['#country'] = 'Country is required.';
			}
			if (empty($data['state'])) {
				$this->data['error']['#state'] = 'State is required.';
			}
			if (empty($data['city'])) {
				$this->data['error']['#city'] = 'City is required.';
			}
			if (strlen(trim($data['phone'])) == 0) {
				$this->data['error']['#phone '] = 'Phone is required.';
			} elseif (strlen(trim($data['phone'])) < 5) {
				$this->data['error']['#phone '] = 'Invalid phone number.';
			}
			if (strlen(trim($data['zip_code'])) == 0) {
				$this->data['error']['#zip_code'] = 'Zip code is required.';
			} else if(strlen(trim($data['zip_code'])) != 6) {
				$this->data['error']['#zip_code'] = 'Invalid Zip Code.';
			}
			if (strlen(trim($data['web_site'])) == 0) {
				$this->data['error']['#web_site'] = 'Web site is required.';
			}
			if (strlen(trim($data['address'])) == 0) {
				$this->data['error']['#address'] = 'Address is required.';
			}
			$this->data['tab'] = '#tab-cli-details';
			if (!empty($this->data['error'])) {
				error($this->data);
			}
			if (strlen(trim($data['username'])) == 0) {
				$this->data['error']['#username'] = 'Username is required.';
			} elseif (is_duplicate('clients', 'username', ['username' => trim($data['username'])])) {
				$this->data['error']['#username'] = 'Duplicate username found.';
			}
			if (strlen(trim($data['password'])) == 0) {
				$this->data['error']['#password'] = 'Password is required.';
			} elseif (!checkPwdStrength($this->request->getPost('password'))) {
				$this->data['error']['#password'] = 'Enter a strong password.';
			}
			if ($this->request->getPost('password') != $this->request->getPost('confirm_password')) {
				$this->data['error']['#confirm_password'] = "Password confirmation doesn't match Password";
			}
			$this->data['tab'] = '#tab-cli-auth';
			if (!empty($this->data['error'])) {
				error($this->data);
			}

			$data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			$data['provider_id'] = $this->session->providerData['id'];
			$data['added_by'] = $this->session->providerData['id'];
			$data['created_at'] = strtotime('now');
			unset($data['confirm_password']);
			if ($lastId = $this->crud->add('clients', $data)) {
				$this->data['success'] = true;
				$this->data['message'] = 'Client data has been successfully added.';
				echo json_encode($this->data); die;
			}
		} else if (($this->request->getMethod() == "get") && !$this->request->isAjax()) {
			$this->data['title'] = 'Add Client';
			return view($this->config->views['add-client'], $this->data);
		}
	}

	public function updateClient($id = 0)
	{
		if (($this->request->getMethod() == "get") && !$this->request->isAjax() && $id) {
			$id = decrypt($id);
			$this->data['details'] = $details = $this->crud->select('clients', '', ['id' => $id, 'provider_id' => $this->session->providerData['id']], '', TRUE);
			if (!empty($details)) {
				$this->data['country'] = $this->crud->select('countries', '', ['id' => $details->country], '', TRUE);
				$this->data['state'] = $this->crud->select('states', '', ['id' => $details->state], '', TRUE);
				$this->data['city'] = $this->crud->select('cities', '', ['id' => $details->city], '', TRUE);
			}else {
				return redirect()->route('clients');
			}
			$this->data['title'] = 'Update Client';
			return view($this->config->views['update-client'], $this->data);
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

	public function updateClientDetails($id = '')
	{
		if (($this->request->getMethod() == "post") && $this->request->isAjax()) { 
			$id = decrypt($id);
			if (!is_numeric($id)) {
				$this->data['message'] = 'Something went wrong';
				error($this->data);
			}

			$data = $this->request->getPost();
			if (strlen(trim($data['name'])) == 0) {
				$this->data['error']['#name'] = 'Name is required.';
			}
			if (strlen(trim($data['email'])) == 0) {
				$this->data['error']['#email'] = 'Email is required.';
			} elseif (!isValidEmail(trim($data['email']))) {
				$this->data['error']['#email'] = 'Invalid email address.';
			} elseif (is_duplicate('clients', 'email', ['email' => trim($data['email']), 'id<>' => $id])) {
				$this->data['error']['#email'] = 'Duplicate email address found.';
			}
			if (empty($data['country'])) {
				$this->data['error']['#country'] = 'Country is required.';
			}
			if (empty($data['state'])) {
				$this->data['error']['#state'] = 'State is required.';
			}
			if (empty($data['city'])) {
				$this->data['error']['#city'] = 'City is required.';
			}
			if (strlen(trim($data['phone'])) == 0) {
				$this->data['error']['#phone '] = 'Phone is required.';
			} elseif (strlen(trim($data['phone'])) < 5) {
				$this->data['error']['#phone '] = 'Invalid phone number.';
			}
			if (strlen(trim($data['zip_code'])) == 0) {
				$this->data['error']['#zip_code'] = 'Zip code is required.';
			} else if(strlen(trim($data['zip_code'])) != 6) {
				$this->data['error']['#zip_code'] = 'Invalid Zip Code.';
			}
			if (strlen(trim($data['web_site'])) == 0) {
				$this->data['error']['#web_site'] = 'Web site is required.';
			}
			if (strlen(trim($data['address'])) == 0) {
				$this->data['error']['#address'] = 'Address is required.';
			}
			if (!empty($this->data['error'])) {
				error($this->data);
			}

			$data['last_updated_by'] = $this->session->providerData['id'];
			$data['updated_at'] = strtotime('now');
			if ($this->crud->updateData('clients', ['id' => $id, 'provider_id' => $this->session->providerData['id']], $data)) {
				$this->data['success'] = true;
				$this->data['message'] = 'Client details has been successfully updated.';
				echo json_encode($this->data); die;
			}
		}
	}

	public function updateClientAuthDetails($id = '')
	{
		if (($this->request->getMethod() == "post") && $this->request->isAjax()) { 
			$id = decrypt($id);
			if (!is_numeric($id)) {
				$this->data['message'] = 'Something went wrong';
				error($this->data);
			}

			$data = $this->request->getPost();
			if (strlen(trim($data['username'])) == 0) {
				$this->data['error']['#username'] = 'Username is required.';
			} elseif (is_duplicate('clients', 'username', ['username' => trim($data['username']), 'id<>' => $id])) {
				$this->data['error']['#username'] = 'Duplicate username found.';
			}
			if (!empty(trim($data['password']))) {
				if (!checkPwdStrength($this->request->getPost('password'))) {
					$this->data['error']['#password'] = 'Enter a strong password.';
				}
				if ($this->request->getPost('password') != $this->request->getPost('confirm_password')) {
					$this->data['error']['#confirm_password'] = "Password confirmation doesn't match Password";
				}
			}
			
			if (!empty($this->data['error'])) {
				error($this->data);
			}

			if (!empty($password)) {
				$data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			} else {
				unset($data['password']);
			}
			unset($data['confirm_password']);

			$data['last_updated_by'] = $this->session->providerData['id'];
			$data['updated_at'] = strtotime('now');
			if ($this->crud->updateData('clients', ['id' => $id, 'provider_id' => $this->session->providerData['id']], $data)) {
				$this->data['success'] = true;
				$this->data['message'] = 'Client auth details has been successfully updated.';
				echo json_encode($this->data); die;
			}
		}
	}
}
