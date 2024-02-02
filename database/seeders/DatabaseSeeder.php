<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Chris Nowlan',
            'type' => 'admin',
            'email' => 'chrisnowlan321@gmail.com',
            'password' => '$2y$10$WsQg/YFGixkwLfJf4O8Lk.6o0ece8Meo9vFHdImNm5S0GxBCsya8C',
        ]);

        User::factory()->create([
            'name' => 'Cindy Rudd',
            'type' => 'admin',
            'email' => 'cinboop@gmail.com',
            'password' => '$2y$10$jXE5E1lf6iBm9YgiRqTWe.RJlxQ9Tu4PECGY/Ces1t/TU3hJKGWGi',
        ]);

        User::factory()->create([
            'name' => 'Davis',
            'type' => 'admin',
            'email' => 'emailslapper@gmail.com',
            'password' => '$2y$10$WsQg/YFGixkwLfJf4O8Lk.6o0ece8Meo9vFHdImNm5S0GxBCsya8C',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$XvNrIe8olyUQnechcmNFjOilzdq3ahezsSl3onaaOUaWTBrObDn22',
        ]);


        User::factory(10)->create();

        $this->call([
//            InstrumentSeeder::class,
        ]);
    }
}
