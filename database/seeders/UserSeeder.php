<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
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
        User::updateOrCreate([
            'role_id'  => Role::where('slug','admin')->first()->id,
            'name'     => 'Admin',
            'email'    => 'admin@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        $employeeRoleId = Role::where('slug', 'employee')->first()->id;

        // Array of user data
        $users = [
            ['id' => '2', 'name' => 'Fazleh Rabbi'],
            ['id' => '1', 'name' => 'AL Shahriar'],
            ['id' => '5', 'name' => 'Md. Muftehedul Islam Mithul'],
            ['id' => '8', 'name' => 'Md. Tarequr Rahman'],
            ['id' => '40001', 'name' => 'M A Taher'],
            ['id' => '40005', 'name' => 'Md. Fazla Arafat'],
            ['id' => '7', 'name' => 'Nurul Islam'],
            ['id' => '30024', 'name' => 'Asif Kamal Tias'],
            ['id' => '30025', 'name' => 'Sheikh Salah Uddin'],
            ['id' => '30028', 'name' => 'Sazzad Hossain'],
            ['id' => '3', 'name' => 'Samiul Islam'],
            ['id' => '10', 'name' => 'Md. Reduan Shahriar'],
            ['id' => '9', 'name' => 'Tahsina Shiva'],
            ['id' => '30045', 'name' => 'Nur Islam'],
            ['id' => '30047', 'name' => 'Saied Ahammed Foyez'],
            ['id' => '40002', 'name' => 'Syed Ishtiaque Ahmed'],
            ['id' => '4', 'name' => 'Md Aslam Arafat'],
            ['id' => '40004', 'name' => 'Nusrat Zahan Sumaya'],
            ['id' => '30052', 'name' => 'Zobayda Akter'],
        ];

        // Creating or updating users
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['emp_id' => $userData['id']],
                [
                    'role_id'  => $employeeRoleId,
                    'name'     => $userData['name'],

                    'email'    => strtolower(str_replace(' ', '.', $userData['name'])) . '@nextgenitltd.com',
                    'password' => Hash::make('password'),
                    'status'   => true
                ]
            );
        }
    }
    }

