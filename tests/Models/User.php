<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Factories\UserFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'age', 'gender', 'hobbies', 'password',
    ];

    protected $casts = [
        'age' => 'integer',
        'hobbies' => 'array',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
