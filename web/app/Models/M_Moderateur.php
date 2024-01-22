<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Moderateur extends M_Utilisateur {

protected $table = 'moderateur';
protected $primaryKey = 'utilisateur_id';


protected $returnType = 'object';
}