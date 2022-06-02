<?php
namespace AdminPlan\Config;

use CodeIgniter\Config\BaseConfig;

class AdminPlan extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'plans' => 'AdminPlan\Views\plan-list',
    ];

    // Layout for the views to extend
    public $viewLayout = 'AdminTemplate\Views\layout';
}
