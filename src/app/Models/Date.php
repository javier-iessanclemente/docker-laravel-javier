<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Date extends Authenticatable
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
        'fecha',
        'hora',
        'duracion',
        'marca',
        'matricula',
        'modelo',
     ];
     
     /**
      * Relación: una cita pertenece a un usuario (cliente).
     */
     public function cliente(): BelongsTo
     {

        return $this->belongsTo(User::class, 'id_cliente');
     }

    public static function rules($userId = null)
    {
        return [
            'id_cliente' => 'required|exists:users,id',
            'fecha' => 'nullable|date|after:today',
            'hora' => 'nullable|date_format:H:i',
            'duracion' => 'nullable|integer',
            'marca'=> 'required|string',
            'matricula'=> 'required|string|regex:/^[0-9]{4}[A-Z]{3}$/',
            'modelo'=> 'required|string'
        ];
    }
}
