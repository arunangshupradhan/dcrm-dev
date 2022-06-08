<?php
namespace ProviderPackage\Config;

use CodeIgniter\Config\BaseConfig;

class ProviderPackage extends BaseConfig
{
    public $views = [
        'plans' => 'ProviderPackage\Views\plan-list',
        'plans-checkout' => 'ProviderPackage\Views\plans-checkout',
    ];

    // Layout for the views to extend
    public $viewLayout = 'ProviderTemplate\Views\layout';
}
