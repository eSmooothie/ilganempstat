<?php
namespace App\Models;

use CodeIgniter\Model;

class Employment extends Model{
    protected $table = 'employment_history';
    protected $allowedFields = ['DATE', 'BRGY_ID', 'ESTABLISHMENT_ID','FEMALE_WORKER','MALE_WORKER'
    ,'RESIDENTIAL_WORKER','TOTAL_WORKER','BUSINESS_CAPITAL','BUSINESS_GROSS','USER_ID'];
}
?>