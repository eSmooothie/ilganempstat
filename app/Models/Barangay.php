<?php
namespace App\Models;

use CodeIgniter\Model;

class Barangay extends Model{
    protected $table = 'barangay';
    protected $allowedFields = ['NAME'];
}
?>