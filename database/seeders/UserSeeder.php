<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    
    {

        // Create the admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // firstOrCreate the Passager role
        $passagerRole = Role::firstOrCreate(['name' => 'Passager']);

        // firstOrCreate the Condicteur role
        $conducteurRole = Role::firstOrCreate(['name' => 'Conducteur']);

        // Create the user with admin privileges
        $adminUser = User::create([
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
           'remember_token' => Str::random(10),
        ]);

        // Assign the admin role to the admin user
        $adminUser->assignRole($adminRole);

        // Create the users
        

        // Create the user
        $user = User::create([
            'nom' => "Ndiaye",
            'prenom' => "Aminata Assane ",
            'email' => "amina.ndiaye@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        // Assign the admin role to the user
        $user->assignRole($passagerRole);

        
        $user = User::create([
            'nom' => "Talla",
            'prenom' => "Aminata Assane ",
            'email' => "conducteur@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Assign the conducteur role to the user
        $user->assignRole($conducteurRole);



        $user = User::create([
            'nom' => "Talla",
            'prenom' => "Cheikh Saliou",
            'email' => "cheikhSaliou@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Assign the conducteur role to the user
        $user->assignRole($conducteurRole);


        $user = User::create([
           'nom' => "Sagna",
            'prenom' => "Moussa",
            'email' => "sagna.moussa@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Assign the conducteur role to the user
        $user->assignRole($passagerRole);
        
        

        // Create the users
        // $users = [
        //     [
        //         'nom' => "Ndiaye",
        //         'prenom' => "Aminata Assane ",
        //         'email' => "amina.ndiaye@gmail.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ],
        //     [
        //         'nom' => "Talla",
        //         'prenom' => "Cheikh Saliou",
        //         'email' => "cheikhSaliou@gmail.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ],
        //     [
        //         'nom' => "Sagna",
        //         'prenom' => "Moussa",
        //         'email' => "sagna.moussa@gmail.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ],
        //     [
        //         'nom' => "Fall",
        //         'prenom' => "Adijaratou Oumy",
        //         'email' => "adijaratouOumy.fall@gmail.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ],
        //     [
        //         'nom' => "Marone",
        //         'prenom' => "Anna",
        //         'email' => "anna.marone@gmail.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ],
        // ];

        // foreach ($users as $userData) {
        //     // Vérifiez si l'utilisateur existe déjà
        //     if (!User::where('email', $userData['email'])->exists()) {
        //         $user = User::create($userData);
        //         // Assignez le rôle à l'utilisateur (si nécessaire)
        //          $role = Role::where('name', 'role_name')->first();
        //          if ($role) {
        //             $user->assignRole($role);
        //         }
        //     }
        // }
    }
}
