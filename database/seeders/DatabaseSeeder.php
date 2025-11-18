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

        $kategoriMakanan = Category::create(['nama' => 'Makanan']);
        Category::create(['nama' => 'Minuman']);
        Category::create(['nama' => 'Kesehatan']);
        Category::create(['nama' => 'Melayang']);


        Product::create([
            'category_id' => $kategoriMakanan->id,
            'nama' => 'Burger',
            'deskripsi' => 'Burger atau hamburger adalah salah satu makanan cepat saji yang paling populer di dunia. Dari restoran cepat saji hingga restoran mewah, makanan ini telah menjadi favorit banyak orang karena kepraktisan dan kelezatannya. Artikel ini akan membahas secara lengkap mengenai sejarah, pengertian, jenis, bahan, dan cara membuatnya.',
            'stok' => 10,
            'harga' => 20000,
            'image1' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
            'image2' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
            'image3' => '01KA6WYA06TNA95QYJC86S0YAG.jpg',
        ]);
    }
}
