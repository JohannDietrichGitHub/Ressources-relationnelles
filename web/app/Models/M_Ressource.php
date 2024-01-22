<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Ressource extends Model {

protected $table = 'ressource';
protected $primaryKey = 'ressource_id';
protected $allowedFields = [
    'ressource_titre',
    'ressource_contenu',
    'ressource_archive',
    'ressource_exploite',
    'ressource_valide',
    'ressource_commentaire_id'
];

protected $returnType = 'object';
}
