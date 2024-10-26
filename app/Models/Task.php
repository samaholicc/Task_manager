<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'user_id', ];// Assurez-vous que votre table de tâches a une colonne 'user_id'
    protected $guarded = [];

    protected $dates = ['date_echeance', 'heure_echeance'];
    /**
     * Obtient l'utilisateur propriétaire de la tâche.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
