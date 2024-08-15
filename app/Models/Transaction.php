<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin',
        'hopital',
        'quantite',
        'type',
        'group_sanguin',
        'updated_at'
    ];

    public function adminUser()
    {
        return $this->belongsTo(User::class, 'admin');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hopital');
    }
}
