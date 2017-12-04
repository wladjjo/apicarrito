<?php

namespace App\Http\Controllers\Seller;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $vendedores = Seller::has('products')->get();
       return $this->showAll($vendedores);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        
         return $this->showOne($seller);
    }

  }   

    
