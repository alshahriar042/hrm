<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();

        Role::updateOrCreate([
            'name'  => 'Admin',
            'slug'    => 'admin',
            'deletable' => false
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name'  => 'Employee',
            'slug'    => 'employee',
            'deletable' => false
        ]);
    }
}
