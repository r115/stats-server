<?php

namespace R115\Profile\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    protected $table = 'profiles';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name'
    ];
}
