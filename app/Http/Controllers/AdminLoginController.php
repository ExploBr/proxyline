<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Обработка попыток аутентификации.
     */
    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

         
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $credentials = request(['email', 'password']);

            $token = auth('api')->attempt($credentials);
            if($token === false){
                return response()->json(['error' => 'Unauthorized'], 401);
            }
         
           
            return redirect()->route('admin.index')->with('token',[$this->respondWithToken($token)]);
  
        }

        return back()->withErrors([
            'email' => 'Предоставленные учетные данные не соответствуют нашим записям.',
        ])->onlyInput('email');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
