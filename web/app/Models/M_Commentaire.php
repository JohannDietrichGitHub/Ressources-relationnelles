<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Commentaire extends Model {

protected $table = 'commentaire';
protected $primaryKey = 'commentaire_id';
protected $allowedFields = [
    'commentaire_txt',
    'commentaire_visibilite',
    'commentaire_reponse_id'
];

protected $returnType = 'object';
}