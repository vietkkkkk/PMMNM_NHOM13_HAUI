<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminModel;
use App\Models\RolesModel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        AdminModel::truncate();
        $adminRoles = RolesModel::where('name', 'admin')->first();
        $authorRoles = RolesModel::where('name', 'author')->first();
        $userRoles = RolesModel::where('name', 'user')->first();
        
        $admin = AdminModel::create([
            'admin_name' => 'phatadmin',
            'admin_user' => 'admin',
            'admin_phone' => '0123789654',
            'admin_password' => md5('123456789')
        ]);
        $author = AdminModel::create([
            'admin_name' => 'phatauthor',
            'admin_user' => 'phatauthor@gmail.com',
            'admin_phone' => '0123987654',
            'admin_password' => md5('123456789')
        ]);
        $user = AdminModel::create([
            'admin_name' => 'phatuser',
            'admin_user' => 'phatuser@gmail.com',
            'admin_phone' => '0321789654',
            'admin_password' => md5('123456789')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
