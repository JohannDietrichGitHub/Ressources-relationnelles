<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Ressource extends Model {

protected $table = 'ressource';
protected $primaryKey = 'RES_ID';
protected $allowedFields = [
    'RES_NOM',
    'RES_EXPLOITE',
    'RES_ETAT',
    'RES_CONTENU',
    'RES_TYPE',
    'RES_DATE_CREATION',
    'RES_DATE_MODIFICATION',
    'RES_UTI_ID',
    'RES_CAT_ID',
];

// Définir la table de liaison
protected $pivotTable = 'ressource_relations';

// Définir la clé étrangère pour la table
protected $foreignKey = 'ressource_id';

// Définir la clé étrangère pour la table "relation"
protected $relatedKey = 'relation_id';


protected $returnType = 'object';
}
