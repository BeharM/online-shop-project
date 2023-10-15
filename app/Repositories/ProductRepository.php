<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductTags;
use App\Repositories\Interface\BaseRepositoryInterface;
use Carbon\Carbon;
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

    public function store($request){
            $product = new Product();
            $product->name = $request->get('name');
            $product->image = $request->get('file_name');
            $product->brand = $request->get('brand');
            $product->model = $request->get('model');
            $product->registration_date = $request->get('registration_date');
            $product->engine_size = (double)$request->get('engine_size');
            $product->price = (double)$request->get('price');
            $product->description = $request->get('description')??null;
            $product->active = $request->get('active')?1:0;
            $product->created_by = auth()->id();
            $product->created_at = Carbon::now();

            if ($product->save()){
                $productTags = $request->get('tags');
                if ($productTags) {
                    $data = [];
                    //get all cart orders and store in db as item for created order above
                    foreach ($productTags as $key => $value) {
                        $data[$key]['product_id'] = $product->id;
                        $data[$key]['tag_id'] = $value;
                        $data[$key]['created_at'] = Carbon::now();
                    }

                    if (ProductTags::insert($data)) {//bulk insert order items
                        return $product;
                    }
                }else{
                    return  $product;
                }
            }

            return false;
    }
}
