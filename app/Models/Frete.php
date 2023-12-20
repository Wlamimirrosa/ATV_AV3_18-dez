<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    protected $fillable = [
        'descricao', 'valor',
    ];
}
