<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        #permissions
        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'view permissions']);

        #roles
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'view roles']);
    
        #posts
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'view posts']);

        #categories
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'view categories']);

        #comments
        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'delete comment']);
        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'edit comment']);

        #users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'change own password']);
        Permission::create(['name' => 'change other user password']);
        Permission::create(['name' => 'deactive user']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit user']);

        // create roles and assign created permissions

        #create a no role with no permissions
        $role = Role::create(['name' => 'no-role']);

        #create a regular role and assign permissions
        $role = Role::create(['name' => 'regular'])
        ->givePermissionTo([
            'create comment',
            'edit comment',
            'delete comment'
        ]);

        #create a admin role and assign permissions
        $role = Role::create(['name' => 'author'])
            ->givePermissionTo([
                'create comment',
                'edit comment',
                'delete comment',

                'view posts',
                'delete post',
                'create post',
                'edit post',
            ]);

        #create a super-admin role and assign permissions
        $role = Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        #assign user super-admin the role of a super-admin
        User::find(1)->assignRole('admin');

        #assign user admin the role of a super
        User::find(2)->assignRole('author');

        #assign user regular the role of a regular
        User::find(3)->assignRole('regular');
    }
}