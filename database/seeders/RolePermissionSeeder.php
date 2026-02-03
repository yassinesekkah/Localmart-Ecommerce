<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            // Client
            'view-products',
            'add-to-cart',
            'create-order',
            'view-orders',
            'like-product',
            'rate-product',
            
            // Seller
            'create-product',
            'edit-product',
            'delete-product',
            'set-price-stock',
            'manage-stock',
            'update-order-status',
            
            // Admin
            'manage-users',
            'manage-roles',
            'moderate-products-reviews',
            'view-all-orders',
            'view-statistics',
            
            // Moderator
            'delete-review',
            'hide-review',
            'suspend-user',
            'suspend-product'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        // Client role
        $clientRole = Role::firstOrCreate(['name' => 'client']);
        $clientRole->givePermissionTo([
            'view-products',
            'add-to-cart',
            'create-order',
            'view-orders',
            'like-product',
            'rate-product'
        ]);

        // Seller role
        $sellerRole = Role::firstOrCreate(['name' => 'seller']);
        $sellerRole->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product',
            'set-price-stock',
            'manage-stock',
            'update-order-status'
        ]);

        // Moderator role
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $moderatorRole->givePermissionTo([
            'delete-review',
            'hide-review',
            'suspend-user',
            'suspend-product'
        ]);

        // Admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'manage-users',
            'manage-roles',
            'moderate-products-reviews',
            'view-all-orders',
            'view-statistics'
        ]);


        
        // create demo users
        $client = User::firstOrCreate([
            'email' => 'client@localmart.com'
        ], [
            'name' => 'Client Test',
            'password' => bcrypt('password'),
        ]);
        $client->assignRole($clientRole);

        $seller = User::firstOrCreate([
            'email' => 'seller@localmart.com'
        ], [
            'name' => 'Seller Test',
            'password' => bcrypt('password'),
        ]);
        $seller->assignRole($sellerRole);

        $moderator = User::firstOrCreate([
            'email' => 'moderator@localmart.com'
        ], [
            'name' => 'Moderator Test',
            'password' => bcrypt('password'),
        ]);
        $moderator->assignRole($moderatorRole);

        $admin = User::firstOrCreate([
            'email' => 'admin@localmart.com'
        ], [
            'name' => 'Admin Test',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        $this->command->info('Rôles, permissions et utilisateurs de test créés avec succès!');
    }
}
