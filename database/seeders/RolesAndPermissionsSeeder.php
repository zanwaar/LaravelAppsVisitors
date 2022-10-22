<?php

namespace Database\Seeders;

use App\Models\Bagian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $default_user = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'name' => 'admin web',
            ], $default_user));
            $operator = User::create(array_merge([
                'email' => 'operator@gmail.com',
                'name' => 'operator',
            ], $default_user));

            $roleOperator = Role::create(['name' => 'operator']);
            $roleAdmin = Role::create(['name' => 'admin']);

         
            Permission::create(['name' => 'read role']);
            Permission::create(['name' => 'create role']);
            Permission::create(['name' => 'update role']);
            Permission::create(['name' => 'delete role']);

            Permission::create(['name' => 'read tamu']);
            Permission::create(['name' => 'create tamu']);
            Permission::create(['name' => 'update tamu']);
            Permission::create(['name' => 'delete tamu']);

            $roleAdmin->givePermissionTo('read role');
            $roleAdmin->givePermissionTo('create role');
            $roleAdmin->givePermissionTo('update role');
            $roleAdmin->givePermissionTo('delete role');
            $roleAdmin->givePermissionTo('read tamu');
            $roleAdmin->givePermissionTo('create tamu');
            $roleAdmin->givePermissionTo('update tamu');
            $roleAdmin->givePermissionTo('delete tamu');

            $roleOperator->givePermissionTo('read tamu');
            $roleOperator->givePermissionTo('create tamu');
            $roleOperator->givePermissionTo('update tamu');
            $roleOperator->givePermissionTo('delete tamu');


            $operator->assignRole('operator');
            $admin->assignRole('admin');

            Bagian::create([
                'namaTenant' => 'Ruang Ophar UPDK',
                'penanggungJawab' => 'Wawan Hudayana',
                'tlpn' => '0811422103',
                'email' => 'wawan.hudayana@pln.co.id',
                'lantaiTenant' => 'UPDK Lt. 1',
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
