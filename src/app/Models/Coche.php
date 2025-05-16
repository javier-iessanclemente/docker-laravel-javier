<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coche extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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

