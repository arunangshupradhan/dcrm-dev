<?php

namespace App\Validation;

use Config\Services;


class ValidateCaptcha 
{
	public function validateCaptcha(string $str, string $fields, array $data)
	{
        $session = \Config\Services::session();
		$captcha = $data['captcha'];
		if ($captcha == $session->captcha) {
			$session->remove('captcha');
            return true;  
        } else {
        	$session->remove('captcha');
            return false;
        }
	}
}	