<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class User extends Model
{ 
	
	protected $table = 'user';
	protected $allowedFields = ['id','firstname','lastname','email','phone'];

	public function createUser($data){
		
		$db = \Config\Database::connect();
		$builder = $db->table('user');
		$result = $builder->insert($data);
		return ($result != 1) ? false : true;

	}

	
}