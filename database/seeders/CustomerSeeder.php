<?php
// database/seeders/CustomerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Budi Santoso', 'phone' => '08123456789', 'address' => 'Jl. Merdeka No.1', 'email' => 'budi@mail.com'],
            ['name' => 'Ani Wijaya', 'phone' => '08198765432', 'address' => 'Jl. Mawar No.2', 'email' => 'ani@mail.com'],
        ];

        foreach ($customers as $cust) {
            Customer::create($cust);
        }
    }
}
