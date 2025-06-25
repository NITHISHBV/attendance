<?php
namespace App\Models;
use CodeIgniter\Model;

class AttendanceModel extends Model {
    protected $table = 'attendance';
    protected $allowedFields = ['user_id', 'name','type', 'location'];
    protected $returnType = 'array';
}
?>