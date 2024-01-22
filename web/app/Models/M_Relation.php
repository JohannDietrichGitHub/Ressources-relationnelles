<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Relation extends Model {

protected $table = 'relation';
protected $primaryKey = 'relation_id';
protected $allowedFields = [
    'relation_type'
];

protected $returnType = 'object';
}
