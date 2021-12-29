<?php
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model{
    protected $table = 'users';
    protected $allowedFields = ['USERNAME', 'PASSWORD', 'IS_ACTIVE', 'DATE_CREATED','FIRSTNAME','LASTNAME'];
}
?>