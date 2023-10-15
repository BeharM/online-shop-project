<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display products view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = null;
        if($keywords = $request->get('search')){
            $filter['search'] = $keywords;
        };
        $products = $this->productRepository->getProducts(25, $filter);

        return view('home.home-page', compact('products'));
    }

    /**
     * Display product cart orders view.
     *
     * @return \Illuminate\View\View
     */
    public function orders(Request $request)
    {
        $sessionCart = Session::get('cart');
        $totalPrice = 0;
        if ($sessionCart) {
            $totalPrice = array_sum(array_map(function($item) {
                return $item['price']*$item['quantity'];
            }, $sessionCart));
        }
        $orders = $this->paginate($sessionCart, 25, null, $request);
        return view('home.view-orders', compact('orders', 'totalPrice'));
    }

    public function paginate($items, $perPage, $page, $request)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

}
