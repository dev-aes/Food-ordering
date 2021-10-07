<?php

namespace Database\Seeders;

use App\Models\Tax;
use App\Models\Role;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // create fake roles
        $roles = array(['name' => 'admin', 'created_at' => now()],
                       ['name' => 'user', 'created_at' => now()]);

       Role::insert($roles);

        // create fake users
       User::create([
            'name' => 'admin', 
            'email' => 'admin@gmail.com' , 
            'password' => '$2y$10$UPNEWO.3925PqB8KN1tl..IFHJSKBINMWxKZNBWB9hBMfNlayuue6',
            'role_id' => 1 
        ]); // pw = test1234

       User::create([
            'name' => 'user', 
            'email' => 'user@gmail.com' , 
            'password' => '$2y$10$UPNEWO.3925PqB8KN1tl..IFHJSKBINMWxKZNBWB9hBMfNlayuue6',
            'role_id' => 2 
        ]); // pw = test1234


        // create fake categoires
        $categories = array(['name' => 'Burger 🍔', 'created_at' => now()], 
                            ['name' => 'Beverage 🧃', 'created_at' => now()], 
                            ['name' => 'Combo Meal 🥙', 'created_at' => now()]);

       Category::insert($categories);

        // create fake taxes

        $taxes = array(['tax' => 0.05,'status' => 0, 'created_at' => now()], 
                       ['tax' => 0.15, 'status' => 1, 'created_at' => now()]);

       Tax::insert($taxes);

        // create fake coupons

        $coupons = array(['code' => 'FO2021','status' => 1, 'discount' => 0.03, 'created_at' => now()], 
                         ['code' => 'ACE2021','status' => 1, 'discount' => 0.05, 'created_at' => now()]);

       Coupon::insert($coupons);


        // create fake menu

        $products = array(
            ['category_id' => 1 , 'name' => 'Cheese Burger 🍔', 'price' => '25', 'created_at' => now()],
            ['category_id' => 1 , 'name' => 'Pizza Burger 🍔', 'price' => '35', 'created_at' => now()],
            ['category_id' => 1 , 'name' => 'Beef Burger 🍔', 'price' => '25', 'created_at' => now()],
            ['category_id' => 2 , 'name' => 'Simple drink 🍾', 'price' => '15', 'created_at' => now()],
            ['category_id' => 2 , 'name' => 'Jack Daniels 🍾', 'price' => '25', 'created_at' => now()],
            ['category_id' => 3 , 'name' => 'Super Combo Meal 🥙', 'price' => '55', 'created_at' => now()],
        );

       Product::insert($products);


    }
}
