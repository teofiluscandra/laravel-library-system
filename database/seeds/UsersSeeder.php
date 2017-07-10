<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Staff;
use App\Member;

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
        $admin->name = 'Kepala Perpustakaan';
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

        $member_data = new Member();
        $member_data->user_id = $member->id;
        $member_data->kode_member = "KD0001";
        $member_data->tempat_lahir = "Denpasar";
        $member_data->tanggal_lahir = "1994-01-01";
        $member_data->no_identitas = "123-123-123";
        $member_data->alamat = "Sesetan";
        $member_data->jenis_kelamin = "Laki-laki";
        $member_data->save();

        // Membuat sample member
        $staff = new User();
        $staff->name = "Sample Staff";
        $staff->email = 'staff@gmail.com';
        $staff->password = bcrypt('rahasia');
        $staff->role = 'staff';
        $staff->is_verified = 1;
        $staff->save();
        $staff->attachRole($staffRole);

        $staff_data = new Staff();
        $staff_data->user_id = $staff->id;
        $staff_data->nip = "123-123";
        $staff_data->telp = "087858687999";
        $staff_data->alamat = "Sesetan";
        $staff_data->jenis_kelamin = "Laki-laki";
        $staff_data->save();
    }
}
