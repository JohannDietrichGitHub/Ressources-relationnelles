<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Appartenir extends Model {
    protected $table = 'Appartenir';
    protected $allowedFields = ['APP_ID_RES', 'APP_ID_REL'];
}