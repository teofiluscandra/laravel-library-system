<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role admin
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Membuat role member
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();

        // Membuat role staff
        $staffRole = new Role();
        $staffRole->name = "staff";
        $staffRole->display_name = "Staff";
        $staffRole->save();

        // Membuat sample admin
        $admin = new User();
        $admin->name = 'Admin Dinas Kearsipan dan Perpustakaan Provinsi Bali';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('rahasia');
        $admin->role = 'admin';
        $admin->is_verified = 1;
        $admin->save();
        $admin->attachRole($adminRole);

        // Membuat sample member
        $member = new User();
        $member->name = "Sample Member";
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->role = 'member';
        $member->is_verified = 1;
        $member->save();
        $member->attachRole($memberRole);

        // Membuat sample member
        $staff = new User();
        $staff->name = "Sample Staff";
        $staff->email = 'staff@gmail.com';
        $staff->password = bcrypt('rahasia');
        $staff->role = 'staff';
        $staff->is_verified = 1;
        $staff->save();
        $staff->attachRole($staffRole);
    }
}
