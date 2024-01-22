<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Discussion extends Model {

protected $table = 'discussion';
protected $primaryKey = 'discussion_id';
protected $allowedFields = [
    'discussion_message_id'
];

protected $returnType = 'object';
}