<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Message extends Model {

protected $table = 'messsage';
protected $primaryKey = 'message_id';
protected $allowedFields = [
    'message_txt',
    'message_visibilite',
];

protected $returnType = 'object';
}