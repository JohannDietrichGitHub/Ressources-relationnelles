<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Utilisateur extends Model {

protected $table = 'utilisateur';
protected $primaryKey = 'UTI_ID';
protected $allowedFields = [
    'UTI_CIVILITE',
    'UTI_NOM',
    'UTI_PRENOM',
    'UTI_ADRESSE',
    'UTI_CP',
    'UTI_VILLE',
    'UTI_NUM_TEL',
    'UTI_MAIL',
    'UTI_ETAT',
    'UTI_MDP',
    'UTI_DATE_CREATION',
    'UTI_DATE_NAISSANCE',
    'UTI_ID_ROL',
    'UTI_ACT_ID'
];

// Définir la table de liaison
protected $pivotTable = 'user_favoris';

// Définir la clé étrangère pour la table
protected $foreignKey = 'UTI_ID';

// Définir la clé étrangère pour la table "reponse"
protected $relatedKey = 'ressource_id';

protected $returnType = 'object';

public function authenticate($mail, $mdp)
    {
        // Vérifier les informations d'identification dans la base de données
        $user = $this->where('UTI_MAIL', $mail)->first();   
        if ($user && password_verify($mdp, $user->UTI_MDP)) {
            // Les informations d'identification sont correctes, retourner l'utilisateur
            return $user;
        }

        // Les informations d'identification sont incorrectes, retourner null
        return null;
    }
}