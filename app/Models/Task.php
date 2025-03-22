<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'date_echeance',
        'heure_echeance',
        'user_id',
        'completed',
        'category',
        'priority',
        'position',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'date_echeance' => 'date:Y-m-d', // Cast as a date (Y-m-d format)
        'heure_echeance' => 'string', // Treat as a string to preserve H:i format
        'completed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtient l'utilisateur propriétaire de la tâche.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}