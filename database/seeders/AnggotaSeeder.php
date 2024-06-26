<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_anggota = Role::updateOrCreate(['name' => User::ROLE_ANGGOTA]);

        $anggota = User::updateOrCreate(
            [
                'name' => 'Anggota',
                'username' => 'anggota',
                'email' => 'anggota@perpus.id',
            ],
            [
                'address' => 'Subang',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            ]
        )->assignRole($role_anggota);

        $card = Card::updateOrCreate(
            [
                'user_id' => $anggota->getKey(),
                'number' => str($anggota->getKey())->padLeft(5, '0')
            ],
            [
                'start_date' => now(),
                'end_date' => now()->addYear()
            ]
        );
        $card->user()->associate($anggota);
        $card->save();
    }
}
