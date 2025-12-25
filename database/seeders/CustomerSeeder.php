<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 customers with 1-3 addresses each
        Customer::factory(50)
            ->has(
                Address::factory()
                    ->count(fake()->numberBetween(1, 3))
                    ->state(function (array $attributes, Customer $customer) {
                        // Make sure one address is always default for each customer
                        static $defaultSet = [];

                        if (!isset($defaultSet[$customer->id])) {
                            $defaultSet[$customer->id] = true;
                            return ['is_default' => true];
                        }

                        return ['is_default' => false];
                    })
            )
            ->create();

        // Create some specific customers for testing
        $testCustomer = Customer::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'phone' => '+34 123 456 789',
            'is_active' => true,
        ]);

        // Create addresses for the test customer
        Address::factory()->create([
            'customer_id' => $testCustomer->id,
            'type' => 'home',
            'street_address' => 'Calle Mayor 123',
            'city' => 'Madrid',
            'state' => 'Madrid',
            'postal_code' => '28001',
            'country' => 'España',
            'is_default' => true,
        ]);

        Address::factory()->create([
            'customer_id' => $testCustomer->id,
            'type' => 'work',
            'street_address' => 'Avenida de la Castellana 456',
            'city' => 'Madrid',
            'state' => 'Madrid',
            'postal_code' => '28046',
            'country' => 'España',
            'is_default' => false,
        ]);
    }
}
