<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Date;
use App\Models\Coche;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'taller',
        ]);

        User::factory()->create([
            'name' => 'Javier Pérez',
            'email' => 'javier@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);

        $user = User::inRandomOrder()->first();

        Date::create([
            'id_cliente' => $user->id,
            'fecha' => (new DateTime())->format('Y-m-d'),
            'hora' => (new DateTime())->format('H:i'),
            'duracion' => 30,
            'marca' => 'Seat',
            'matricula' => '1234JPR',
            'modelo' => 'Seat 500',
        ]);

        $user = User::inRandomOrder()->first();

        Date::create([
            'id_cliente' => $user->id,
            'fecha' => null,
            'hora' => (new DateTime())->format('H:i'),
            'duracion' => 30,
            'marca' => 'Fiat',
            'matricula' => '4321POI',
            'modelo' => 'Fiat 500',
        ]);

        $user = User::inRandomOrder()->first();

        Date::create([
            'id_cliente' => $user->id,
            'fecha' => (new DateTime())->format('Y-m-d'),
            'hora' => null,
            'duracion' => 30,
            'marca' => 'Seat',
            'matricula' => '4567LOU',
            'modelo' => 'Seat 500',
        ]);

        $user = User::inRandomOrder()->first();

        Date::create([
            'id_cliente' => $user->id,
            'fecha' => (new DateTime())->format('Y-m-d'),
            'hora' => (new DateTime())->format('H:i'),
            'duracion' => null,
            'marca' => 'Alpha',
            'matricula' => '8765TRE',
            'modelo' => 'Alpha Romeo',
        ]);

        Date::create([
            'id_cliente' => $user->id,
            'fecha' => null,
            'hora' => null,
            'duracion' => null,
            'marca' => 'Ferrari',
            'matricula' => '8765TRE',
            'modelo' => 'Ferrari 2000',
        ]);

        Coche::create([
            'id_cliente' => 1,
            'marca' => 'Seat',
            'modelo' => 'Seat 500',
            'matricula' => '1234POI',
        ]);

        Coche::create([
            'id_cliente' => 2,
            'marca' => 'Fiat',
            'modelo' => 'Fiat 600',
            'matricula' => '4321LIP',
        ]);
    }
}
