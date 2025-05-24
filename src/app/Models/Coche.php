<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_cliente',
        'marca',
        'modelo',
        'matricula',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Coche::class, 'id_cliente');
    }

    public static function rules($userId = null)
    {
        return [
            'id_cliente' => 'required|exists:users,id',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'matricula' => 'required|string|regex:/^[0-9]{4}[A-Z]{3}$/',
        ];
    }
}