<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interface\BaseRepositoryInterface;
use DB;

class ProductRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function getProducts($row=25, $filter=null){
        $products = Product::with('tags')->where('active', 1);

        if ($filter){
            $products->filter($filter);
        }
        return $products->paginate($row);
    }
}
