<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

