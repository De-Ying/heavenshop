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
        Role::create(['name'=>'administrator', 'display_name'=>'Quản trị viên']);
        Role::create(['name'=>'merchandiser', 'display_name'=>'Quản lí đơn hàng']);
        Role::create(['name'=>'product-management', 'display_name'=>'Quản lí sản phẩm']);
        Role::create(['name'=>'post-management', 'display_name'=>'Quản lí bài viết']);
        Role::create(['name'=>'interface-management', 'display_name'=>'Quản lí giao diện']);
        Role::create(['name'=>'customer-care', 'display_name'=>'Chăm sóc khách hàng']);

        Permission::create(['name'=>'product-category-management', 'display_name'=>'Quản lý danh mục sản phẩm']);
        Permission::create(['name'=>'brand-management', 'display_name'=>'Quản lý thương hiệu']);
        Permission::create(['name'=>'product-management', 'display_name'=>'Quản lý sản phẩm']);
        Permission::create(['name'=>'supplier-management', 'display_name'=>'Quản lý nhà cung cấp']);
        Permission::create(['name'=>'shipping-fee-management', 'display_name'=>'Quản lý phí vận chuyển']);
        Permission::create(['name'=>'customer-comment-management', 'display_name'=>'Quản lý bình luận khách hàng']);
        Permission::create(['name'=>'post-category-management', 'display_name'=>'Quản lý danh mục bài viết']);
        Permission::create(['name'=>'post-management', 'display_name'=>'Quản lý bài viết']);
        Permission::create(['name'=>'order-management', 'display_name'=>'Quản lý đơn hàng']);
        Permission::create(['name'=>'slider-management', 'display_name'=>'Quản lý slider']);
        Permission::create(['name'=>'contact-management', 'display_name'=>'Quản lý liên hệ']);
        Permission::create(['name'=>'discount-management', 'display_name'=>'Quản lý mã giảm giá']);
        Permission::create(['name'=>'customer-management', 'display_name'=>'Quản lý khách hàng']);
        Permission::create(['name'=>'user-management', 'display_name'=>'Quản lý người dùng']);
        Permission::create(['name'=>'user-role-management', 'display_name'=>'Quản lý vai trò người dùng']);
        Permission::create(['name'=>'user-permission-management', 'display_name'=>'Quản lý phân quyền người dùng']);
        Permission::create(['name'=>'revenue-statistics', 'display_name'=>'Thống kê doanh thu']);
        Permission::create(['name'=>'inventory-statistics', 'display_name'=>'Thống kê giá trị tồn kho']);
        Permission::create(['name'=>'bill-statistics', 'display_name'=>'Thống kê hóa đơn']);
    }
}
