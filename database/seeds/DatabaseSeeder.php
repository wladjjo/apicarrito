<?php


use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Product::truncate();
        Transaction::truncate();
     
     $cantidadUsuarios = 150;
     $cantidadCategorias= 30;
     $cantidadProductos = 500;
     $cantidadTrasacciones = 500; 


     factory(User::class, $cantidadUsuarios)->create();
      factory(Category::class, $cantidadCategorias)->create();

     factory(Product::class, $cantidadTransacciones)->create()->each(function ($producto){
        $categorias = Category::all()->random(mt_rand(1, 5))->pluck('id');//con pluck Solo TENER EL ID...
        $producto->categories()->attach($categorias);
     });

     factory(Transaction::class, $cantidadTransacciones)->create();

     }
}
