<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizedPersonnel extends Model
{	
	protected $table = 'authorized_personnels';

    protected $fillable = [
        'ap_name', 'ap_position'
    ];
}
