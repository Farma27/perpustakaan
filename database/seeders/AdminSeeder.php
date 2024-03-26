<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_administrator = Role::updateOrCreate(['name' => User::ROLE_ADMINISTRATOR]);

        $administrator = User::updateOrCreate(
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@perpus.id'
            ],
            [
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            ]
        )->assignRole($role_administrator);

        $card = Card::updateOrCreate(
            [
                'user_id' => $administrator->getKey(),
                'number' => str($administrator->getKey())->padLeft(5, '0')
            ],
            [
                'start_date' => now(),
                'end_date' => now()->addYear()
            ]
        );
        $card->user()->associate($administrator);
        $card->save();
    }
}
