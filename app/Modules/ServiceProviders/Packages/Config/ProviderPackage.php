<?php
namespace ProviderPackage\Config;

use CodeIgniter\Config\BaseConfig;

class ProviderPackage extends BaseConfig
{
    public $views = [
        'plans' => 'ProviderPackage\Views\plan-list',
    ];

    // Layout for the views to extend
    public $viewLayout = 'ProviderTemplate\Views\layout';
}
