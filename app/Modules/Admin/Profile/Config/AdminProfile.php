<?php
namespace AdminProfile\Config;

use CodeIgniter\Config\BaseConfig;

class AdminProfile extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'admin-login' => 'AdminProfile\Views\admin-login',
        'admin-forgot-password' => 'AdminProfile\Views\admin-forgot',
        'admin-reset-password' => 'AdminProfile\Views\admin-reset',
    ];

    // Layout for the views to extend
    public $viewLayout = 'AdminProfile\Views\layout';
}
