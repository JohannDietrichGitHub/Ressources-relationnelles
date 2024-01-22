<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Commentaire extends Model {

protected $table = 'commentaire';
protected $primaryKey = 'commentaire_id';
protected $allowedFields = [
    'commentaire_txt',
    'commentaire_visibilite',
];

// Définir la table de liaison
protected $pivotTable = 'commentaire_reponses';

// Définir la clé étrangère pour la table
protected $foreignKey = 'commentaire_id';

// Définir la clé étrangère pour la table "reponse"
protected $relatedKey = 'reponse_id';


protected $returnType = 'object';
}