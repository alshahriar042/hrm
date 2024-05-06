<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*~~~~~~~~~~~~~~ For User Part~~~~~~~~~~~~~~*/
        $moduleDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $moduleDashboard->id,
            'name'      => 'Access Dashboard',
            'slug'      => 'dashboard'
        ]);


        /*~~~~~~~~~~~~~~ For Role Part~~~~~~~~~~~~~~*/
        $moduleRole = Module::updateOrCreate(['name' => 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Access Role',
            'slug'      => 'roles.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Create Role',
            'slug'      => 'roles.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Create Role',
            'slug'      => 'roles.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Edit Role',
            'slug'      => 'roles.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Delete Role',
            'slug'      => 'roles.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For User Part~~~~~~~~~~~~~~*/
        $moduleUser = Module::updateOrCreate(['name' => 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Access User',
            'slug'      => 'users.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Create User',
            'slug'      => 'users.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Show User',
            'slug'      => 'users.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Edit User',
            'slug'      => 'users.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Delete User',
            'slug'      => 'users.destroy'
        ]);

        /*~~~~~~~~~~~~~~ For Department Part~~~~~~~~~~~~~~*/
        $moduleDepartment = Module::updateOrCreate(['name' => 'Department Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleDepartment->id,
            'name'      => 'Access Department',
            'slug'      => 'departments.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleDepartment->id,
            'name'      => 'Create Department',
            'slug'      => 'departments.create'
        ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleDepartment->id,
        //     'name'      => 'Show Department',
        //     'slug'      => 'departments.show'
        // ]);

        Permission::updateOrCreate([
            'module_id' => $moduleDepartment->id,
            'name'      => 'Edit Department',
            'slug'      => 'departments.edit'
        ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleDepartment->id,
        //     'name'      => 'Delete Department',
        //     'slug'      => 'departments.destroy'
        // ]);

        /*~~~~~~~~~~~~~~ For Attendance Part~~~~~~~~~~~~~~*/
        $moduleAttendance = Module::updateOrCreate(['name' => 'Attendance Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAttendance->id,
            'name'      => 'Access Attendance',
            'slug'      => 'attendance.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAttendance->id,
            'name'      => 'Attendance Details',
            'slug'      => 'attendance.details'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAttendance->id,
            'name'      => 'Attendance report',
            'slug'      => 'attendance.report'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAttendance->id,
            'name'      => 'My Attendance',
            'slug'      => 'my.attendance'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAttendance->id,
            'name'      => 'My Attendance Report',
            'slug'      => 'my.attendance.report'
        ]);

        /*~~~~~~~~~~~~~~ For Reconciliation Part~~~~~~~~~~~~~~*/
        $moduleReconciliation = Module::updateOrCreate(['name' => 'Reconciliation Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleReconciliation->id,
            'name'      => 'Access Reconciliation',
            'slug'      => 'reconciliations.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleReconciliation->id,
            'name'      => 'Create Reconciliation',
            'slug'      => 'reconciliations.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleReconciliation->id,
            'name'      => 'Pending Reconciliation',
            'slug'      => 'pending.reconciliation'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleReconciliation->id,
            'name'      => 'Approve Reconciliation',
            'slug'      => 'approve.reconciliation'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleReconciliation->id,
            'name'      => 'Reject Reconciliation',
            'slug'      => 'reject.reconciliation'
        ]);

    }
}
