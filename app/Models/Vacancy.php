<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'id','indexjob','httpjob','vacancy','company',
        'time','vacancyInfoWrapper','category','cityVacancyCity','add_base',
        'company_id',
    ];
}

