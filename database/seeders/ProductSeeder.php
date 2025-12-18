<?php
// database/seeders/ProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'Roti Sosis', 'price' => 10000, 'stock' => 50],
            ['category_id' => 1, 'name' => 'Roti Coklat', 'price' => 8000, 'stock' => 40],
            ['category_id' => 2, 'name' => 'Tart Coklat', 'price' => 150000, 'stock' => 5],
            ['category_id' => 2, 'name' => 'Tart Keju', 'price' => 160000, 'stock' => 3],
            ['category_id' => 3, 'name' => 'Es Teh Manis', 'price' => 5000, 'stock' => 100],
            ['category_id' => 3, 'name' => 'Kopi Susu', 'price' => 12000, 'stock' => 60],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
