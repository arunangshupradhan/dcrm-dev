<?php namespace ProviderProfile\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table      = 'users';
	protected $primaryKey = 'id';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'name', 'group_id', 'email', 'user_name', 'new_email', 'password', 'password_confirm',
		'activate_hash', 'reset_hash', 'reset_expires', 'active', 'password_hash'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'int';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'updateAccount' => [
			'id'	=> 'required|is_natural_no_zero',
			'name'	=> 'required|min_length[2]'
		],
		'changeEmail' => [
			'id'			=> 'required|is_natural_no_zero',
			'new_email'		=> 'required|valid_email|is_unique[users.email]',
			'activate_hash'	=> 'required'
		]
	];

	protected $validationMessages = [];

	protected $skipValidation = false;

	// this runs after field validation


    //--------------------------------------------------------------------

    /**
     * Retrieves validation rule
     */
	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}

    //--------------------------------------------------------------------

    /**
     * Hashes the password after field validation and before insert/update
     */

}
