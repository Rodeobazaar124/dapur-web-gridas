<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    

    protected function  major(): BelongsTo
    {
        return $this->BelongsTo(Major::class);
    }    

    public function user(): HasOne
    {
        return $this->HasOne(User::class);
    }
}
