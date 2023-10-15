<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegistrationController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(8) ],
        ]);
        DB::beginTransaction();
        try {


            if ($user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ])){
                DB::commit();
            }else{
                DB::rollBack();
                return redirect()->back()->withErrors(['email' => 'An Error Has Occurred']);
            }
            Auth::login($user);

            return redirect()->route('home')->with('success', "Account successfully registered.");
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['email' => 'An Error Has Occurred']);
        }
    }

}
