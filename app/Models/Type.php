<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Interact with the type's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Get the breeds for the type.
     */
    public function breeds(): HasMany
    {
        return $this->hasMany(Breed::class)->select('id', 'name');
    }

    /**
     * Get the pets for the type.
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class)->select('id', 'name', 'user_id', 'breed_id');
    }
}
