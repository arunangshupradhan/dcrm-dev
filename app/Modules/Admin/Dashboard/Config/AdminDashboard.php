<?php
namespace AdminDashboard\Config;

use CodeIgniter\Config\BaseConfig;

class AdminDashboard extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'dashboard' => 'AdminDashboard\Views\dashboard',
    ];

    // Layout for the views to extend
    public $viewLayout = 'AdminTemplate\Views\layout';
}
