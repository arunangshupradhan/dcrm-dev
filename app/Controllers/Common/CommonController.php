<?php

namespace App\Controllers\Common;
use App\Controllers\BaseController;
use App\Models\Common\CommonModel;

class CommonController extends BaseController
{

    public function __construct()
    {
        $db = db_connect();
        $this->common = new CommonModel($db);
        $this->data['success'] = false;
        $this->data['hash'] = csrf_hash();
    }


    function ajaxGetCountryListDd(){
        if ($this->request->isAjax() && $this->request->getMethod() == 'post') {
            $result = $this->common->ajaxGetCountryListDd($this->request->getPost('searchTerm'));
            $data = array();
            if (!empty($result)) {
                foreach ($result as $res) {
                    $data[] = array("id"=>$res->id, "text"=>$res->name.' ('.$res->shortname.')', 'shortname' => $res->shortname);
                }
            }
            echo json_encode($data); exit;
        }
    }

    function ajaxGetStateListDd(){
        if ($this->request->isAjax() && $this->request->getMethod() == 'post') {
            $result = $this->common->ajaxGetStateListDd($this->request->getPost('countryId'), $this->request->getPost('searchTerm'));
            $data = array();
            if (!empty($result)) {
                foreach ($result as $res) {
                    $data[] = array("id"=>$res->id, "text"=>$res->name);
                }
            }
            echo json_encode($data); exit;
        }
    }

    function ajaxGetCityListDd(){
        if ($this->request->isAjax() && $this->request->getMethod() == 'post') {
            $result = $this->common->ajaxGetCityListDd($this->request->getPost('stateId'), $this->request->getPost('searchTerm'));
            $data = array();
            if (!empty($result)) {
                foreach ($result as $res) {
                    $data[] = array("id"=>$res->id, "text"=>$res->name);
                }
            }
            echo json_encode($data); exit;
        }
    }
}
