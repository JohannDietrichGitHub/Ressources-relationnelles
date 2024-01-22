<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Role extends Model {

protected $table = 'role';
protected $primaryKey = 'role_Id';
protected $allowedFields = [
    'role_nom'
];

protected $returnType = 'object';
}