<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
    
    public function file(): HasMany
    {
        return $this->hasMany(File::class);
    }
}