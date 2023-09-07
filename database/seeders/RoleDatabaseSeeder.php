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

            ['name' => 'create-product','display_name'=>' Create product', 'group'=>'product'],
            ['name' => 'update-product','display_name'=>' Update product', 'group'=>'product'],
            ['name' => 'show-product','display_name'=>' Show product', 'group'=>'product'],
            ['name' => 'delete-product','display_name'=>' Delete product', 'group'=>'product'],

            ['name' => 'create-coupon','display_name'=>' Create coupon', 'group'=>'coupon'],
            ['name' => 'update-coupon','display_name'=>' Update coupon', 'group'=>'coupon'],
            ['name' => 'show-coupon','display_name'=>' Show coupon', 'group'=>'coupon'],
            ['name' => 'delete-coupon','display_name'=>' Delete coupon', 'group'=>'coupon'],

            // ['name' => 'list-order','display_name'=>'list order ', 'group'=>'orders'],
            // ['name' => 'update-order-stattus','display_name'=>' Update oder status', 'group'=>'orders'],
        ];
        foreach($permissions as $item){
            Permisson::updateOrCreate($item);
        }
    }
}
