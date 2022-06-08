<?php
namespace ProviderDashboard\Config;

use CodeIgniter\Config\BaseConfig;

class ProviderDashboard extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'dashboard' => 'ProviderDashboard\Views\dashboard',
    ];

    // Layout for the views to extend
    public $viewLayout = 'ProviderTemplate\Views\layout';
}
