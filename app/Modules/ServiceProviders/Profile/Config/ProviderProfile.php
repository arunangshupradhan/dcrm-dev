<?php
namespace ProviderProfile\Config;

use CodeIgniter\Config\BaseConfig;

class ProviderProfile extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'sign-up' => 'ProviderProfile\Views\sign-up',
        'providers-login' => 'ProviderProfile\Views\login',
        'forgot-password' => 'ProviderProfile\Views\forgot-password',
        'reset-password' => 'ProviderProfile\Views\reset-password',
    ];

    // Layout for the views to extend
    public $viewLayout = 'ProviderProfile\Views\layout';
}
