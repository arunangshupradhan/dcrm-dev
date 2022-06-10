<?php namespace App\Models\Common;

use CodeIgniter\Model;

class CommonModel extends Model
{
    protected $db;

    public function __construct($db)
    {
        $this->db =& $db;
        $this->builder = $this->db->table('countries');
        $this->city = $this->db->table('cities');
        $this->state = $this->db->table('states');
    }

    public function ajaxGetCountryListDd($keyword = '')
    {
        $this->builder->select('*');
        if (!empty($keyword)) {
            $this->builder->like('name', $keyword);
            $this->builder->orLike('shortname', $keyword);
        }
        $this->builder->orderBy('name', 'asc');
        $this->builder->limit(50);
        $data = $this->builder->get()->getResult();
        if (!empty($data)) {
            return $data;
        }
    }

    public function ajaxGetStateListDd($countryId = 0, $keyword = '')
    {
        $this->state->select('*');
        $this->state->where('country_id', $countryId);
        if (!empty($keyword)) {
            $this->state->like('name', $keyword);
        }
        $this->state->orderBy('name', 'asc');
        $this->state->limit(50);
        $data = $this->state->get()->getResult();
        if (!empty($data)) {
            return $data;
        }
    }

    public function ajaxGetCityListDd($stateId = 0, $keyword = '')
    {
        $this->city->select('*');
        $this->city->where('state_id', $stateId);
        if (!empty($keyword)) {
            $this->city->like('name', $keyword);
        }
        $this->city->orderBy('name', 'asc');
        $this->city->limit(50);
        $data = $this->city->get()->getResult();
        if (!empty($data)) {
            return $data;
        }
    }

}
