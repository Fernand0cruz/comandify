<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // scopeAvailable:
    // Query Scope é uma convenção no Laravel para criar métodos reutilizáveis de consulta.
    // O método available() filtra os produtos que estão disponíveis. Exemplo:
    // Product::available()->get(); Retorna todos os produtos disponíveis.
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
