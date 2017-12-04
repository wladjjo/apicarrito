<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $fillable =[
        'name',
        'description',
    ];

    protected function products()
    {
    	return $this->belongsToMany(Product::class);
    }
}
