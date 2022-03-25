<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class User extends Model
{ 
	
	protected $table = 'user';
	protected $allowedFields = ['id','firstname','lastname','email','phone'];

	
}