<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'produto_id', 'quantidade', 'valor_total',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
