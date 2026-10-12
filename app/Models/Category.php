<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the tasks belonging to this category.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}