<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Relation extends Model {

protected $table = 'relation';
protected $primaryKey = 'REL_ID';
protected $allowedFields = [
    'REL_TYPE'
];

protected $returnType = 'object';
}
