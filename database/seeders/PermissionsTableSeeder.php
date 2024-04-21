<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define our permissions
        $permissions = [
            'view-bidder',
            'edit-bidder',
            'create-bidder',
            'view-bidders-list',
            'view-bidders-topBidders',
            'view-bidders-disqualifiedBidders-system',
            'bidders-import-execute',
            'houses-import-execute',
            'houses-categories-delete',
            'houses-categories-edit',
            'houses-categories-create',
            'houses-categories-view',
            'houses-view',
            'disqualified-bidders-update',
            'disqualified-bidders-view',
            'houses-create',
            'houses-edit',
            'houses-delete',
            'log-access',
            'station-view',
            'station-create',
            'station-edit',
            'station-delete',
            'user-view',
            'user-create',
            'user-edit',
            'user-delete',
            'role-view',
            'role-create',
            'role-edit',
            'role-delete',
            'agreement-access',
            'agreement-create',
            'agreement-edit',
            'agreement-delete',
            'settings-view',
            'settings-list',
            'settings-create',
            'settings-edit',
            'settings-delete',
            'results-view',
            'results-list',
            'results-create',
            'results-edit',
            'results-delete',
            'reports-view',
            'reports-list',
            'reports-create',
            'reports-edit',
            'reports-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $roleAdmin = Role::create(['name' => 'Admin']);
        // $roleEncoder = Role::create(['name' => 'encoder']);

        // Assign all permissions to the admin role
        $roleAdmin->givePermissionTo(Permission::all());

        // Assign teacher and houses permissions to the encoder role
        // $encoderPermissions = [
        //     'bidders-list',
        //     'bidders-show',
        //     'bidders-create',
        //     'bidders-update',
        //     'bidders-delete',
        //     'bidders-search',
        //     'bidders-result',
        //     'bidders-import-view',
        //     'bidders-import-execute',
        //     'houses-import-view',
        //     'houses-import-execute',
        //     'dashboard',
        //     'houses-categories-view',
        //     'houses-categories-create',
        //     'houses-categories-edit',
        //     'houses-categories-delete',
        //     'houses-view',
        //     'houses-create',
        //     'houses-edit',
        //     'houses-delete',
        // ];
        // $roleEncoder->givePermissionTo($encoderPermissions);
    }
}
