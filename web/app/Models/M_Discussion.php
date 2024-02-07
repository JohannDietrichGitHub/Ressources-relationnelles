<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Discussion extends Model {

protected $table = 'discussion';
protected $primaryKey = 'discussion_id';
protected $allowedFields = [
    'discussion_message_id'
];

// Définir la table de liaison
protected $pivotTable = 'discussion_messages';

// Définir la clé étrangère pour la table
protected $foreignKey = 'discussion_id';

// Définir la clé étrangère pour la table "message"
protected $relatedKey = 'message_id';


protected $returnType = 'object';
}