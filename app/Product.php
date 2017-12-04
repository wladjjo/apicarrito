<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    
  use SoftDeletes;

  
	const PRODUCTO_DISPONIBLE = 'disponible';
	const PRODUCTO_NO_DISPONIBLE = 'no disponible';
   
   protected $dates = ['deleted_at'];
    protected $fillable = [
       'name',
       'description',
       'quantity',
       'status',
       'seller_id',

    ];

    public function estaDisponible(){
    	return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    public function categories(){
      return $this->belongsToMany(Category::class);
     }
     
     public function seller(){
      return $this->belongsTo(Seller::class);
     }

      public function transactions(){
        return $this->hasMany(Transaction::class);
     }



}


