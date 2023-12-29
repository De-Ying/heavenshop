<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoles = Role::where('name', 'administrator')->first();
        $merchandiserRoles = Role::where('name', 'merchandiser')->first();
        $productManagementRoles = Role::where('name', 'product-management')->first();
        $postManagementRoles = Role::where('name', 'post-management')->first();
        $interfaceManagementRoles = Role::where('name', 'interface-management')->first();
        $customerCareRoles = Role::where('name', 'customer-care')->first();

        $admin = Admin::create([
            'full_name'  => 'Nguyễn Đức Anh',
            'user_name'  => 'Sin Đăng',
            'email'      => 'admin@gmail.com',
            'password'   => bcrypt('HVS1Admin'),
            'avatar'     => 'Jung-Kook.jpg',
            'phone'      => '0332618488',
            'address'    => 'Hà Nội',
            'gender'     => 1
        ]);

        $merchandiser = Admin::create([
            'full_name'  => 'Nguyễn Đức Thắng',
            'user_name'  => 'B.Thắng',
            'email'      => 'merchandiser@gmail.com',
            'password'   => bcrypt('HVS1Merchandiser'),
            'avatar'     => 'J_Sol.jpg',
            'phone'      => '01288032567',
            'address'    => 'Hải Phòng',
            'gender'     => 1
        ]);

        $productManagement = Admin::create([
            'full_name'  => 'Nguyễn Văn Toàn',
            'user_name'  => 'B.Toàn',
            'email'      => 'productM@gmail.com',
            'password'   => bcrypt('HVS1ProductM'),
            'avatar'     => 'J_Min.jpg',
            'phone'      => '01227835249',
            'address'    => 'Đà Nẵng',
            'gender'     => 1
        ]);

        $postManagement = Admin::create([
            'full_name'  => 'Nguyễn Thị Mai',
            'user_name'  => 'G.Mai',
            'email'      => 'postM@gmail.com',
            'password'   => bcrypt('HVS1PostM'),
            'avatar'     => 'Kim_Min.jpg',
            'phone'      => '0398627196',
            'address'    => 'Huế',
            'gender'     => 0
        ]);

        $interfaceManagement = Admin::create([
            'full_name'  => 'Phạm Mai Thúy',
            'user_name'  => 'G.Thúy',
            'email'      => 'interfaceM@gmail.com',
            'password'   => bcrypt('HVS1InterfaceM'),
            'avatar'     => 'Kim_Mon.jpg',
            'phone'      => '0142618466',
            'address'    => 'Nam Định',
            'gender'     => 0
        ]);

        $customerCare = Admin::create([
            'full_name'  => 'Bạch Thị Lan',
            'user_name'  => 'G.Lan',
            'email'      => 'customerC@gmail.com',
            'password'   => bcrypt('HVS1CustomerC'),
            'avatar'     => 'Kim_Mun.jpg',
            'phone'      => '0369754144',
            'address'    => 'Thanh Hóa',
            'gender'     => 0
        ]);

        $admin->roles()->attach($adminRoles);
        $merchandiser->roles()->attach($merchandiserRoles);
        $productManagement->roles()->attach($productManagementRoles);
        $postManagement->roles()->attach($postManagementRoles);
        $interfaceManagement->roles()->attach($interfaceManagementRoles);
        $customerCare->roles()->attach($customerCareRoles);

        $listPermission = Permission::all();
        $adminRoles->permissions()->attach($listPermission);
        // factory(App\Models\Admin::class, 5)->create();
    }
}
