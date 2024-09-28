<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            PassagersSeeder::class,
            ConducteursSeeder::class,
            AdminsSeeder::class,
            VehiculesSeeder::class,
            TrajetsSeeder::class,
            ReservationsSeeder::class,
            // NotificationsSeeder::class,
            PaiementsSeeder::class,
            AvisSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'nom' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
