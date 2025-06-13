<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create-reminder',
            'add-member-reminder',
            'archive-reminder',
            'edit-reminder',
            'send-reminder',
            'view-reminder-member',
            'download-template-member',
            'import-member',
            'export-member',
            'membership-registration',
            'edit-member',
            'delete-member',
            'manage-role',
            'admin-setting'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdminRole = Role::findByName('superadmin');
        $superAdminRole->givePermissionTo(Permission::all());

    }
}
