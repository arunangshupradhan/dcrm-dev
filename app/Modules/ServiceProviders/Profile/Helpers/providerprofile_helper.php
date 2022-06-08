<?php

use Config\Services;

if (! function_exists('send_activation_email'))
{
    /**
    * Builds an account activation HTML email from views and sends it.
    */
    function send_provider_activation_email($to, $activateHash)
    {
    	$htmlMessage = view('ProviderProfile\Views\emails\header');
    	$htmlMessage .= view('ProviderProfile\Views\emails\activation', ['hash' => $activateHash]);
    	$htmlMessage .= view('ProviderProfile\Views\emails\footer');

    	$email = \Config\Services::email();
		$email->initialize([
			'mailType' => 'html'
		]);

    	$email->setTo($to);
        $email->setSubject(lang('Profile.registration'));
		$email->setMessage($htmlMessage);

        return $email->send();
       // $data = $email->printDebugger(['headers']);
       //  pr($data);

    }
}