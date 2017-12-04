<?php

use Faker\Generator as Faker;
use App\User;
use App\Category;
use App\Product;
use App\Buyer;
use App\Seller;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => $verificado = $faker->randomElement([User::USUARIO_VERIFICADO, User::USUARIO_NO_VERIFICADO]),
       // 'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
        'admin' => $faker->randomElement([User::USUARIO_ADMINISTRADOR, User::USUARIO_REGULAR]),
    ];

      });

       $factory->define(Category::class, function (Faker $faker){
            
            
            return [
              'name' => $faker->word,
              'description' => $faker->paragraph(1),
              

            ];


        });



  
        $factory->define(Product::class, function (Faker $faker){
            return [
              'name' => $faker->word,
              'description' => $faker->paragraph(1),
              'quantity' => $faker->numberBetween(1, 10),
              'status' => $faker->randomElement([Product::PRODUCTO_DISPONIBLE, Product::PRODUCTO_NO_DISPONIBLE]),
              'seller_id' => User::all()->random()->id, //no un numero cualqiiera SOLO EXISTENTE


            ];
       
       });


            $factory->define(Transaction::class, function (Faker $faker){
            
             $vendedor = Seller::has('products')->get()->random();//USUARIOS QUE TENGAN PRODUCTOS
             $comprador = User::all()->except($vendedor->id)->random();//USUARIO CUALQUIERA
            return [
              
              
              'quantity' => $faker->numberBetween(1, 3),
              'buyer_id' => $comprador->id,
              'product_id'=> $vendedor->products->random()->id,


            ];


        });
 
