<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Activite extends M_Ressource {

protected $table = 'activite';
protected $primaryKey = 'ressource_id';
protected $allowedFields = [
    'activite_duree',
    'activite_discussion'
];

protected $returnType = 'object';
}