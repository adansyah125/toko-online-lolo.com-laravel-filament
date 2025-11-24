<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>  Hash::make('admin123'),
            'alamat' =>  'kopo',
            'no_telp' =>  1848789347,
            'role' =>  'admin',
        ]);
        User::factory()->create([
            'name' => 'syahdan',
            'email' => 'adansyah225@gmail.com',
            'password' =>  Hash::make('admin123'),
            'alamat' =>  'kopo',
            'no_telp' =>  1848789347,
            'role' =>  'user',
        ]);

        $kategoriAksesoris = Category::create(['nama' => 'Aksesoris']);
        Category::create(['nama' => 'Elektronik']);
        Category::create(['nama' => 'Robotik']);
        Category::create(['nama' => 'Service']);


        Product::create([
            'category_id' => $kategoriAksesoris->id,
            'nama' => 'Keychain',
            'deskripsi' => 'keychain dengan desain unik dan kualitas tinggi untuk kebutuhan Anda. Tersedia dalam berbagai warna dan ukuran. Sangat cocok untuk kebutuhan personal atau bisnis Anda. Buatlah kepercayaan terhadap dirimu sendiri dengan keychain ini. Buatlah kepercayaan terhadap dirimu sendiri dengan keychain ini.',
            'stok' => 10,
            'harga' => 20000,
            'image1' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
            'image2' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
            'image3' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
        ]);
    }
}
