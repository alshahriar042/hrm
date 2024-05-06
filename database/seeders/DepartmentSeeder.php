<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ["Development", "Project Management", "Quality Assurance (QA)", "Database Administration (DBA)", "UI/UX (User Interface/User Experience)", "DevOps (Development and Operations)", "Mobile App Development", "Marketing and Sales", "Human Resources (HR)"];

        foreach ($departments as $key => $department) {
            Department::create([
                'name' => $department
            ]);
        }
    }
}
