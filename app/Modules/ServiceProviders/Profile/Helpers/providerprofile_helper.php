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

    if (! function_exists('send_provider_password_reset_email'))
    {
        function send_provider_password_reset_email($to, $resetHash)
        {
            $htmlMessage = view('ProviderProfile\Views\emails\header');
            $htmlMessage .= view('ProviderProfile\Views\emails\reset', ['hash_url' => $resetHash]);
            $htmlMessage .= view('ProviderProfile\Views\emails\footer');

            $email = \Config\Services::email();
            $email->initialize([
                'mailType' => 'html'
            ]);
            $email->setTo($to);
            $email->setSubject(lang('Profile.passwordResetRequest'));
            $email->setMessage($htmlMessage);

            return $email->send();
        }
    }
}