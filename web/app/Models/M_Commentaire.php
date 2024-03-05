<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Commentaire extends Model {

protected $table = 'commentaire';
protected $primaryKey = 'COM_ID';
protected $allowedFields = [
    'COM_CONTENU',
    'COM_ID_COMMENTAIRE_REPONDU',
    'COM_VISIBILITE',
    'COM_UTI_ID',
    'COM_RES_ID',
    'COM_TSP_CRE'
];

protected $returnType = 'object';
}