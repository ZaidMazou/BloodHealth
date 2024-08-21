<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPocket extends Model
{
    use HasFactory;
    protected $fillable =[
        'group_sanguin',
        'quantite',
        'capacite',
        'hopital'
    ];

    public function hospital()  {
        return $this->belongsTo(Hospital::class);
    }
}
