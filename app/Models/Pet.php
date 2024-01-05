<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'type_id',
        'breed_id'
    ];

    /**
     * Interact with the pet's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Get the user that owns the pet.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'first_name', 'last_name');
    }

    /**
     * Get the type that owns the pet.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)->select('id', 'name');
    }

    /**
     * Get the breed that owns the pet.
     */
    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class)->select('id', 'name');
    }
}
