<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
        'url_parent_site',
        'name_company',
        'url_company',
        'logo_company',
        'company_description',
        'facebook',
        'linkedin',
        'twitter',
        'add_base',
    ];
}
