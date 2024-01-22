<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Commentaire extends Model {

protected $table = 'reponse';
protected $primaryKey = 'reponse_id';
protected $allowedFields = [
    'reponse_txt',
    'reponse_visibilite'
];

protected $returnType = 'object';
}