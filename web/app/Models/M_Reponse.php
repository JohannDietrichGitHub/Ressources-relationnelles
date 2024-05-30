<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Reponse extends Model {

protected $table = 'reponse';
protected $primaryKey = 'reponse_id';
protected $allowedFields = [
    'reponse_txt',
    'reponse_visibilite',
    'reponse_date',
    'reponse_utilisateur',
    'reponse_ressource'
];

protected $returnType = 'object';
}