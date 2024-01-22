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
    'ressource_categorie'
];

// Définir la table de liaison
protected $pivotTable = 'ressource_relations';

// Définir la clé étrangère pour la table
protected $foreignKey = 'ressource_id';

// Définir la clé étrangère pour la table "relation"
protected $relatedKey = 'relation_id';


protected $returnType = 'object';
}
