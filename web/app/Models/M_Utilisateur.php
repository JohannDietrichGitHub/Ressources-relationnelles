<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Utilisateur extends Model {

protected $table = 'utilisateur';
protected $primaryKey = 'user_id';
protected $allowedFields = [
    'user_civilite',
    'user_etat',
    'user_email',
    'user_tel',
    'user_password',
    'user_nom',
    'user_prenom',
    'user_role_id',
    'user_datecrea',
    'user_datenaiss',
    'user_adresse',
    'user_cp'
];

// Définir la table de liaison
protected $pivotTable = 'user_favoris';

// Définir la clé étrangère pour la table
protected $foreignKey = 'user_id';

// Définir la clé étrangère pour la table "reponse"
protected $relatedKey = 'ressource_id';

protected $returnType = 'object';
}