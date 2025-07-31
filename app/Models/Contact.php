<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
    ];

    /**
     * Get the meetings associated with the contact.
     *
     * @return HasMany
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }
}
