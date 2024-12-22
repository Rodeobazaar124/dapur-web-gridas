<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    protected function  teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }    
}