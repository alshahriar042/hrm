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
        // $users = [
        //     ['id' => '2', 'name' => 'Fazleh Rabbi'],
        //     ['id' => '1', 'name' => 'AL Shahriar'],
        //     ['id' => '5', 'name' => 'Md. Muftehedul Islam Mithul'],
        //     ['id' => '8', 'name' => 'Md. Tarequr Rahman'],
        //     ['id' => '40001', 'name' => 'M A Taher'],
        //     ['id' => '40005', 'name' => 'Md. Fazla Arafat'],
        //     ['id' => '7', 'name' => 'Nurul Islam'],
        //     ['id' => '30024', 'name' => 'Asif Kamal Tias'],
        //     ['id' => '30025', 'name' => 'Sheikh Salah Uddin'],
        //     ['id' => '30028', 'name' => 'Sazzad Hossain'],
        //     ['id' => '3', 'name' => 'Samiul Islam'],
        //     ['id' => '10', 'name' => 'Md. Reduan Shahriar'],
        //     ['id' => '9', 'name' => 'Tahsina Shiva'],
        //     ['id' => '30045', 'name' => 'Nur Islam'],
        //     ['id' => '30047', 'name' => 'Saied Ahammed Foyez'],
        //     ['id' => '40002', 'name' => 'Syed Ishtiaque Ahmed'],
        //     ['id' => '4', 'name' => 'Md Aslam Arafat'],
        //     ['id' => '40004', 'name' => 'Nusrat Zahan Sumaya'],
        //     ['id' => '30052', 'name' => 'Zobayda Akter'],
        // ];
        $users = [
            ['id' => '2', 'name' => 'Fazleh Rabbi', 'designation' => 'Asst. Manager Accounts & Admin', 'join_date' => '18-Oct-22', 'email' => 'rabbi@nextgenitltd.com', 'phone1' => '01677303390', 'phone2' => '01572599417', 'emergency_contact' => 'Mother', 'blood_group' => 'O+'],
            ['id' => '1', 'name' => 'AL Shahriar', 'designation' => 'Software Engineer', 'join_date' => '12-Jun-21', 'email' => 'shahriar@nextgenitltd.com', 'phone1' => '01812851004', 'phone2' => '01835243202', 'blood_group' => 'A+'],
            ['id' => '5', 'name' => 'Md. Muftehedul Islam Mithul', 'designation' => 'Software Developer', 'join_date' => '3-Nov-21', 'email' => 'mithul@nextgenitltd.com', 'phone1' => '01791504501', 'phone2' => '01718658992', 'blood_group' => 'AB+'],
            ['id' => '8', 'name' => 'Md. Tarequr Rahman', 'designation' => 'Software Engineer', 'join_date' => '1-Dec-21', 'email' => 'tarequrrahman@nextgenitltd.com', 'phone1' => '01835163868', 'phone2' => '01721480510', 'blood_group' => 'O+'],
            ['id' => '40001', 'name' => 'M A Taher', 'designation' => 'Manager, Business Development', 'join_date' => '1-Jan-22', 'email' => 'taher@nextgenitltd.com', 'phone1' => '01915524878', 'phone2' => '01989293596', 'emergency_contact' => 'Wife', 'blood_group' => 'AB+'],
            ['id' => '40005', 'name' => 'Md. Fazla Arafat', 'designation' => 'Sr. Manager Pre Sales & Delivery', 'join_date' => 'April 1st 2024', 'email'=>'fazla_arafat@nextgenitltd.com', 'phone1' => '01717998754', 'phone2' => '01889605093', 'emergency_contact' => 'Brother', 'blood_group' => 'O+'],
            ['id' => '7', 'name' => 'Nurul Islam', 'designation' => 'Php Developer/Jr. Software Engineer', 'join_date' => '8-Jan-23', 'email' => 'nurulislam@nextgenitltd.com', 'phone1' => '01737971840', 'phone2' => '01735403957', 'emergency_contact' => 'Father', 'blood_group' => 'AB+'],
            ['id' => '30024', 'name' => 'Asif Kamal Tias', 'designation' => 'Php Developer/Jr. Software Engineer', 'join_date' => '10-Jan-23', 'email' => 'Asif@nextgenitltd.com', 'phone1' => '01839385832', 'phone2' => '01711197183', 'blood_group' => 'O+'],
            ['id' => '30025', 'name' => 'Sheikh Salah Uddin', 'designation' => 'Php Developer/Jr. Software Engineer', 'join_date' => '10-Jan-23', 'email' => 'sheikh@nextgenitltd.com', 'phone1' => '01796311449', 'phone2' => '01720288185', 'emergency_contact' => 'Father', 'blood_group' => 'A+'],
            ['id' => '30028', 'name' => 'Sazzad Hossain', 'designation' => 'Frontend Developer', 'join_date' => '19-Jan-23', 'email' => 'Sazzad@nextgenitltd.com', 'phone1' => '01775389591', 'phone2' => '01715626197', 'blood_group' => 'B+'],
            ['id' => '3', 'name' => 'Samiul Islam', 'designation' => 'Php Developer/Jr. Software Engineer', 'join_date' => '5-Mar-23', 'email' => 'samiulislam@nextgenitltd.com', 'phone1' => '01841439398', 'phone2' => '01711475908', 'emergency_contact' => 'Father', 'blood_group' => 'B+'],
            ['id' => '09', 'name' => 'Tahsina Shiva', 'designation' => 'UI/UX Designer', 'join_date' => '9-Apr-23', 'email' => 'shiva@nextgenitltd.com', 'phone1' => '01843080597', 'phone2' => '01618223341', 'emergency_contact' => 'Father', 'blood_group' => 'O+'],
            ['id' => '10', 'name' => 'Md. Reduan Shahriar', 'designation' => 'UI/UX Designer', 'join_date' => '9-Apr-23', 'email' => 'reduan@nextgenitltd.com', 'phone1' => '01843080597', 'phone2' => '01618223341', 'emergency_contact' => 'Father', 'blood_group' => 'O+'],

            ['id' => '30045', 'name' => 'Nur Islam', 'designation' => 'Apps Developer (Trainee)', 'join_date' => '20-Aug-23', 'email' => 'nurislam@nextgenitltd.com', 'phone1' => '01568273901', 'phone2' => '01818398994', 'emergency_contact' => 'Brother', 'blood_group' => 'A+'],
            ['id' => '30047', 'name' => 'Saied Ahammed Foyez', 'designation' => 'Apps Developer', 'join_date' => '1-Sep-23', 'email' => 'saied@nextgenitltd.com', 'phone1' => '01779021219', 'phone2' => '01712622528', 'emergency_contact' => 'Mother', 'blood_group' => 'B+'],
            ['id' => '40002', 'name' => 'Syed Ishtiaque Ahmed', 'designation' => 'Executive, Business Development', 'join_date' => '1-Nov-21', 'email' => 'ishtiaque@nextgenitltd.com', 'phone1' => '01701008863', 'phone2' => '01775589611', 'emergency_contact' => 'Brother', 'blood_group' => 'B+'],
            ['id' => '4', 'name' => 'Md Aslam Arafat', 'designation' => 'Sales Specialist (Trainee)', 'join_date' => 'January 1st 2024', 'email' => 'aslam@nextgenitltd.com', 'phone1' => '01839383245', 'phone2' => '01684726820', 'emergency_contact' => 'Brother', 'blood_group' => 'A+'],
            ['id' => '40004', 'name' => 'Nusrat Zahan Sumaya', 'designation' => 'Telemarketer (Intern)', 'join_date' => 'February 1st 2024', 'email' => 'nusrat@nextgenitltd.com', 'phone1' => '01940939806', 'phone2' => '01929119889', 'emergency_contact' => 'Father', 'blood_group' => 'O+'],
            ['id' => '30052', 'name' => 'Zobayda Akter', 'designation' => 'Software Quallity Assurance (SQA)', 'join_date' => 'March 1st 2024', 'email' => 'zobayda@nextgenitltd.com', 'phone1' => '01779968912', 'phone2' => '01703442185', 'emergency_contact' => 'Mother', 'blood_group' => 'B+'],
            ['id' => '30052', 'name' => 'Zobayda Akter', 'designation' => 'Software Quallity Assurance (SQA)', 'join_date' => 'March 1st 2024', 'email' => 'zobayda@nextgenitltd.com', 'phone1' => '01779968912', 'phone2' => '01703442185', 'emergency_contact' => 'Mother', 'blood_group' => 'B+'],
        ];


        // Creating or updating users
        foreach ($users as $userData) {
            if (array_key_exists('email', $userData)) {
                User::updateOrCreate(
                    ['emp_id' => $userData['id']],
                    [
                        'role_id'  => $employeeRoleId,
                        'name'     => $userData['name'],
                        'email'    =>$userData['email'],
                        'phone'     => $userData['phone1'],
                        'blood_group'     => $userData['blood_group'],
                        'password' => Hash::make('password'),
                        'status'   => true
                    ]
                );
            }
        }
    }
    }

