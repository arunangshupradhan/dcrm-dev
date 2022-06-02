<?php
namespace AdminProfile\Config;

use CodeIgniter\Config\BaseConfig;

class Adminprofile extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'admin-login' => 'Adminprofile\Views\admin-login',
        'headoffice-forgot-password' => 'Adminprofile\Views\headoffice-forgot',
        'headoffice-reset-password' => 'Adminprofile\Views\headoffice-reset',
    ];

    // Layout for the views to extend
    public $viewLayout = 'Adminprofile\Views\layout';
}
