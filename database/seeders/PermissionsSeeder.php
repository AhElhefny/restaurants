<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        $permissions = [
            ['guard_name' => 'web', 'name' => 'users'],
            ['guard_name' => 'web', 'name' => 'add user'],
            ['guard_name' => 'web', 'name' => 'edit user'],
            ['guard_name' => 'web', 'name' => 'show user'],
            ['guard_name' => 'web', 'name' => 'delete user'],
            ['guard_name' => 'web', 'name' => 'roles'],
            ['guard_name' => 'web', 'name' => 'add role'],
            ['guard_name' => 'web', 'name' => 'edit role'],
            ['guard_name' => 'web', 'name' => 'show role'],
            ['guard_name' => 'web', 'name' => 'delete role'],
            ['guard_name' => 'web', 'name' => 'add-permission'],
            ['guard_name' => 'web', 'name' => 'categories'],
            ['guard_name' => 'web', 'name' => 'add category'],
            ['guard_name' => 'web', 'name' => 'edit category'],
            ['guard_name' => 'web', 'name' => 'vendors'],
            ['guard_name' => 'web', 'name' => 'add vendor'],
            ['guard_name' => 'web', 'name' => 'edit vendor'],
            ['guard_name' => 'web', 'name' => 'delete vendor'],
            ['guard_name' => 'web', 'name' => 'show vendor'],
            ['guard_name' => 'web', 'name' => 'branches'],
            ['guard_name' => 'web', 'name' => 'add branch'],
            ['guard_name' => 'web', 'name' => 'edit branch'],
            ['guard_name' => 'web', 'name' => 'show branch'],
            ['guard_name' => 'web', 'name' => 'delete branch'],
            ['guard_name' => 'web', 'name' => 'services'],
            ['guard_name' => 'web', 'name' => 'add service'],
            ['guard_name' => 'web', 'name' => 'edit service'],
            ['guard_name' => 'web', 'name' => 'delete service'],
            ['guard_name' => 'web', 'name' => 'show service'],
            ['guard_name' => 'web', 'name' => 'sizes'],
            ['guard_name' => 'web', 'name' => 'add size'],
            ['guard_name' => 'web', 'name' => 'edit size'],
            ['guard_name' => 'web', 'name' => 'delete size'],
            ['guard_name' => 'web', 'name' => 'sub-categories'],
            ['guard_name' => 'web', 'name' => 'add sub-category'],
            ['guard_name' => 'web', 'name' => 'edit sub-category'],
            ['guard_name' => 'web', 'name' => 'delete sub-category'],
            ['guard_name' => 'web', 'name' => 'show sub-category'],
            ['guard_name' => 'web', 'name' => 'delivery-types'],
            ['guard_name' => 'web', 'name' => 'add delivery-types'],
            ['guard_name' => 'web', 'name' => 'edit delivery-types'],
            ['guard_name' => 'web', 'name' => 'delete delivery-types'],
            ['guard_name' => 'web', 'name' => 'works-time'],
            ['guard_name' => 'web', 'name' => 'edit works-time'],
            ['guard_name' => 'web', 'name' => 'delete works-time'],
            ['guard_name' => 'web', 'name' => 'add works-time'],
            ['guard_name' => 'web', 'name' => 'bank-accounts'],
            ['guard_name' => 'web', 'name' => 'orders'],
            ['guard_name' => 'web', 'name' => 'edit-order'],
            ['guard_name' => 'web', 'name' => 'show-order'],
            ['guard_name' => 'web', 'name' => 'payment-methods'],
            ['guard_name' => 'web', 'name' => 'add payment-methods'],
            ['guard_name' => 'web', 'name' => 'edit payment-methods'],
            ['guard_name' => 'web', 'name' => 'offers'],
            ['guard_name' => 'web', 'name' => 'add offer'],
            ['guard_name' => 'web', 'name' => 'edit offer'],
            ['guard_name' => 'web', 'name' => 'delivery-man'],
            ['guard_name' => 'web', 'name' => 'admins'],
            ['guard_name' => 'web', 'name' => 'add admin'],
            ['guard_name' => 'web', 'name' => 'edit admin'],
            ['guard_name' => 'web', 'name' => 'delete admin'],
            ['guard_name' => 'web', 'name' => 'edit delivery-man'],
            ['guard_name' => 'web', 'name' => 'show delivery-man'],
        ];
        $Admin_role = Role::create([
            'name' => 'super_admin'
        ]);
        $vendor_role = Role::create([
            'name' => 'vendor'
        ]);
        $BM_role = Role::create([
            'name' => 'branch_manager'
        ]);
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'type' =>User::ADMIN,
            'type_ar' => 'مسؤول التطبيق',
            'type_en' => 'admin',
            'email_verified_at' => now(),
        ]);
        Permission::insert($permissions);
        $Admin_role->syncPermissions(Permission::all());
        $user->assignRole($Admin_role);
    }
}
