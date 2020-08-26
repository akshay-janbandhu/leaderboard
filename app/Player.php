<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /** 
     * Database table for players
     */
    protected $table = 'players';

    /**
     * Fillable columns
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'points',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'points' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope active
     */
    public function scopeActive($query)
    {
        return $query->where('players.is_active', '1');
    }
}
