<?php
namespace ProviderClient\Config;

use CodeIgniter\Config\BaseConfig;

class ProviderClient extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'client' => 'ProviderClient\Views\clients',
        'add-client' => 'ProviderClient\Views\add-client',
        'update-client' => 'ProviderClient\Views\update-client',
    ];

    // Layout for the views to extend
    public $viewLayout = 'ProviderTemplate\Views\layout';
}
