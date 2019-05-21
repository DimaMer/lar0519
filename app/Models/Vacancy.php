<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'id','indexjob','httpjob','vacancy','company','company',
        'time','vacancyInfoWrapper','companyDescription','category','cityVacancyCity','add_base',
    ];
}

