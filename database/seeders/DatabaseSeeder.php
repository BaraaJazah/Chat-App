<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'baraa jazah',
            'email' => 'baraajazah@gmail.com',
            'password' => bcrypt("baraajazah"),
            'image' => "https://img.freepik.com/free-photo/waist-up-portrait-handsome-serious-unshaven-male-keeps-hands-together-dressed-dark-blue-shirt-has-talk-with-interlocutor-stands-against-white-wall-self-confident-man-freelancer_273609-16320.jpg?t=st=1743859294~exp=1743862894~hmac=5f6448b201c97243fcefd3ad0a34f087715cec9496501b5ec3da5cdeadeb7135&w=996"
        ]);

        User::factory()->create([
            'name' => 'omer ibrahim',
            'email' => 'example1@gmail.com',
            'password' => bcrypt("example1"),
            'image' => "https://img.freepik.com/premium-photo/attractive-smiling-young-man-glasses-studio-headshot_656932-6164.jpg?w=996"
        ]);

        User::factory()->create([
            'name' => 'samer ali',
            'email' => 'example2@gmail.com',
            'password' => bcrypt("example2"),
            'image' => "https://img.freepik.com/free-photo/artist-white_1368-3546.jpg?t=st=1743859460~exp=1743863060~hmac=7a7462fe06cfc781c0869a9a8cbd1168ea0765ca2e64a1b5778a7f3c8c4edf8f&w=740"
        ]);
    }
}
