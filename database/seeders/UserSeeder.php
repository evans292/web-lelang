<?php

namespace Database\Seeders;

use App\Models\Operator;
use App\Models\People;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('otakugamer'),
        ]);

        Operator::create([
            'user_id' => $admin->id,
            'name' => $admin->name
        ]);

        $petugas = User::create([
            'name' => 'Petugas',
            'role_id' => 2,
            'email' => 'petugas@example.com',
            'password' => Hash::make('otakugamer'),
        ]);
        
        Operator::create([
            'user_id' => $petugas->id,
            'name' => $petugas->name
        ]);

        $masyarakat = User::create([
            'name' => 'Masyarakat',
            'role_id' => 3,
            'email' => 'masyarakat@example.com',
            'password' => Hash::make('otakugamer'),
        ]);

        People::create([
            'user_id' => $masyarakat->id,
            'name' => $masyarakat->name,
            'phone' => '087827698747'
        ]);
    }
}
