<?php

namespace Database\Seeders;

use App\Models\Permisson;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =[
            ['name'=>'super-admin', 'display_name'=>'Super Admin', 'group'=>'system'],
            ['name'=>'admin', 'display_name'=>'Admin', 'group'=>'system'],
            ['name'=>'user', 'display_name'=>'User', 'group'=>'system'],
        ];

        foreach($roles as $role){
            Role::updateOrCreate($role);
        }

        $permissions = [
            ['name' => 'create-user','display_name'=>' Create user', 'group'=>'User'],
            ['name' => 'update-user','display_name'=>' Update user', 'group'=>'User'],
            ['name' => 'show-user','display_name'=>' Show user', 'group'=>'User'],
            ['name' => 'delete-user','display_name'=>' Delete user', 'group'=>'User'],

            ['name' => 'create-role','display_name'=>' Create role', 'group'=>'Role'],
            ['name' => 'update-role','display_name'=>' Update role', 'group'=>'Role'],
            ['name' => 'show-role','display_name'=>' Show role', 'group'=>'Role'],
            ['name' => 'delete-role','display_name'=>' Delete role', 'group'=>'Role'],

            ['name' => 'create-ategory','display_name'=>' Create category', 'group'=>'Category'],
            ['name' => 'update-category','display_name'=>' Update category', 'group'=>'Category'],
            ['name' => 'show-category','display_name'=>' Show category', 'group'=>'Category'],
            ['name' => 'delete-category','display_name'=>' Delete category', 'group'=>'Category'],

            ['name' => 'create-product','display_name'=>' Create product', 'group'=>'Product'],
            ['name' => 'update-product','display_name'=>' Update product', 'group'=>'Product'],
            ['name' => 'show-product','display_name'=>' Show product', 'group'=>'Product'],
            ['name' => 'delete-product','display_name'=>' Delete product', 'group'=>'Product'],

            ['name' => 'create-coupon','display_name'=>' Create coupon', 'group'=>'Coupon'],
            ['name' => 'update-coupon','display_name'=>' Update coupon', 'group'=>'Coupon'],
            ['name' => 'show-coupon','display_name'=>' Show coupon', 'group'=>'Coupon'],
            ['name' => 'delete-coupon','display_name'=>' Delete coupon', 'group'=>'Coupon'],

            ['name' => 'create-size','display_name'=>' Create size', 'group'=>'Size'],
            ['name' => 'update-size','display_name'=>' Update size', 'group'=>'Size'],
            ['name' => 'show-size','display_name'=>' Show size', 'group'=>'Size'],
            ['name' => 'delete-size','display_name'=>' Delete size', 'group'=>'Size'],

            ['name' => 'create-supplier','display_name'=>' Create supplier', 'group'=>'Supplier'],
            ['name' => 'update-supplier','display_name'=>' Update supplier', 'group'=>'Supplier'],
            ['name' => 'show-supplier','display_name'=>' Show supplier', 'group'=>'Supplier'],
            ['name' => 'delete-supplier','display_name'=>' Delete supplier', 'group'=>'Supplier'],

            ['name' => 'create-material','display_name'=>' Create material', 'group'=>'Material'],
            ['name' => 'update-material','display_name'=>' Update material', 'group'=>'Material'],
            ['name' => 'show-material','display_name'=>' Show material', 'group'=>'Material'],
            ['name' => 'delete-material','display_name'=>' Delete material', 'group'=>'Material'],

            ['name' => 'create-import','display_name'=>' Create import', 'group'=>'Import'],
            ['name' => 'update-import','display_name'=>' Update import', 'group'=>'Import'],
            ['name' => 'show-import','display_name'=>' Show import', 'group'=>'Import'],
            ['name' => 'delete-import','display_name'=>' Delete import', 'group'=>'Import'],

            ['name' => 'create-export','display_name'=>' Create export', 'group'=>'Export'],
            ['name' => 'update-export','display_name'=>' Update export', 'group'=>'Export'],
            ['name' => 'show-export','display_name'=>' Show export', 'group'=>'Export'],
            ['name' => 'delete-export','display_name'=>' Delete export', 'group'=>'Export'],

            ['name' => 'list-order','display_name'=>'list order', 'group'=>'orders'],
            ['name' => 'update-order-status','display_name'=>' Update order status', 'group'=>'orders'],
        ];
        foreach($permissions as $item){
            Permisson::updateOrCreate($item);
        }
    }
}
