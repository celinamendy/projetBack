<?php

namespace Database\Seeders;
use App\Models\Passager;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PassagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passagers = [
            [
                'adresse' => 'sacre coeur',
                'telephone' => '778545658',
                'user_id' => 1
            ],
            [
                'adresse' => 'sacre coeur',
                'telephone' => '778545658',
                'user_id' => 2
            ],
        ];

        foreach ($passagers as $passagerData) {
            $passager = Passager::create($passagerData);
        }
    
    }
}
