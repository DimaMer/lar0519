<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id','res_company','name_company','url_company','logo_company','company_description','facebook',
        'linkedin','twiter','add_base',
    ];
}
