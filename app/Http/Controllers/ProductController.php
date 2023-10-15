<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addToCart($id)
    {
        if(!$product = $this->productRepository->find($id)) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        $cart = session()->get('cart');
        // if cart is empty add the first product
        if(!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "model" => $product->model,
                    "photo" => $product->photo
                ]
            ];
            //save session
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exists then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add product to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "model" => $product->model,
            "photo" => $product->photo
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->get('id') and $request->get('quantity')) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                if ($request->quantity == 0) {
                    unset($cart[$request->id]);
                } else {
                    $cart[$request->id]["quantity"] = $request->quantity;
                }

                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');

                return response()->json([
                    'code' => 200,
                    'message' => 'Cart updated successfully',
                ]);
            }
        }

        return response()->json([
            'code' => 400,
            'message' => 'Cart Not Found',
        ]);

    }
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed successfully');
        }
        return redirect()->back()->with('error', 'Product Order Not Found');
    }
}
