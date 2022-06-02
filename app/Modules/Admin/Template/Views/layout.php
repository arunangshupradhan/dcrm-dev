<?php 
use Config\Services;
$this->session = Services::session();
?>
<?= view('AdminTemplate\Views\include\_header') ?>
<?= view('AdminTemplate\Views\include\_sidebar') ?>
<?= view('AdminTemplate\Views\include\_js') ?>
<?= $this->renderSection('main'); ?>
<?= view('AdminTemplate\Views\include\_footer') ?>