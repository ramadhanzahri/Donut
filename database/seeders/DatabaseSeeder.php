<?php

namespace Database\Seeders;

use App\Models\ProfilePerusahaan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default superadmin if not exists
        $superadmin = User::where('username', 'superadmin')->first();
        if (!$superadmin) {
            User::create([
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
            ]);
            $this->command->info('Superadmin created successfully!');
        }

        // Create default profile perusahaan if not exists
        $profile = ProfilePerusahaan::first();
        if (!$profile) {
            ProfilePerusahaan::create([
                'nama_perusahaan' => 'Maw Maw Donut',
                'alamat' => 'Jl. Contoh Alamat No. 123',
                'telepon' => '081528844756',
                'email' => 'info@mawmawdonut.com',
                'deskripsi' => 'Donat lezat dengan berbagai varian rasa.',
                'sejarah' => 'Sejarah perusahaan...',
            ]);
            $this->command->info('Profile perusahaan created successfully!');
        }
    }
}
