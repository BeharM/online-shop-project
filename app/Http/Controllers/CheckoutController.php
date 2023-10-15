<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index()
    {
        if (Auth::user()) {
            return view('home.checkout');
        }else{
            return redirect()->route('login.create')->with('error', 'Please Login Before Purchase Orders');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'card_number' => ['required', 'string'],
        'expiration_date' => ['required', 'string'],
        'cvv' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            if (Auth::user()) {
                //create new order for login user
                if ($order = Order::create([
                    'user_id' => auth()->id(),
                    'name' => $request->get('name'),
                    'card_number' => $request->get('card_number'),
                    'expiration_date' => $request->get('expiration_date'),
                    'cvv' => (int)$request->get('cvv'),
                ])) {
                    $data = [];
                    //get all cart orders and store in db as item for created order above
                    foreach (session('cart') as $key => $cart){
                        $data[$key]['product_id'] = $key;
                        $data[$key]['order_id'] = $order->id;
                        $data[$key]['created_at'] = Carbon::now();
                    }
                    if (OrderItems::insert($data)){//bulk insert order items
                        Session::forget('cart');
                        DB::commit();
                    }
                } else {
                    DB::rollBack();
                    return redirect()->back()->withErrors(['email' => 'An Error Has Occurred!Orders were not saved']);
                }

                return redirect()->route('home')->with('success', "Purchase Orders successfully saved.");
            }else{
                return redirect()->route('login.create')->with('error', 'Please Login Before Purchase Orders');
            }
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['email' => 'An Error Has Occurred']);
        }
    }

}
