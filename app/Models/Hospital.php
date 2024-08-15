<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'adresse',
        'admin',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'hopital');
    }
}
