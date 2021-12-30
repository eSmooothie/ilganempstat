<?php
namespace App\Models;

use CodeIgniter\Model;

class Establishment extends Model{
    protected $table = 'establishment_info';
    protected $allowedFields = ['NAME', 'OWNER', 'BUSINESS_CODE'];
}
?>