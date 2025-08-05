<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions (optional)
        Permission::create(['name' => 'add movie']);
        Permission::create(['name' => 'delete movie']);
        Permission::create(['name' => 'book movie']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['add movie', 'delete movie']);
        $userRole->givePermissionTo(['book movie']);

        // Assign admin role to user with id 1 (adjust if needed)
        $admin = User::find(4);
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
    }

