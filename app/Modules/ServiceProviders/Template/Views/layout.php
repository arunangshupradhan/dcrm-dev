<?php 
use Config\Services;
$this->session = Services::session();
?>
<?= view('ProviderTemplate\Views\include\_header') ?>
<?= view('ProviderTemplate\Views\include\_sidebar') ?>
<?= view('ProviderTemplate\Views\include\_js') ?>
<?= $this->renderSection('main'); ?>
<?= view('ProviderTemplate\Views\include\_footer') ?>