<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (!User::first()) {
            User::create(['name' => 'Admin', 'user_role' => 'admin', 'email' => 'admin@admin.admin', 'password' => Hash::make('admin1001')]);
        }

        $attr = $request->all();
        $validator = Validator::make($attr, [
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(',', $validator->errors()->all()),
                'data' => []
            ]);
        }

        $success = false;
        $data = $validator->validate();
        $login = $data['login'];
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $_ = ['password' => $data['password'], 'email' => $login];
            if (Auth::attempt($_, request()->has('remember'))) {
                $success = true;
            }
        } else if (is_numeric($login)) {
            // $login = (float) $login;
            // if ("243" != substr($login . 0, 3)) {
            //     $login = "243$login";
            // }
            // $login = "+" . $login;
            // $login = "0" . $login;
            $_ = ['password' => $data['password'], 'phone' => $login];
            if (Auth::attempt($_,  request()->has('remember'))) {
                $success = true;
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Veuillez fournir votre email ou votre numéro de tel.",
                'data' => []
            ]);
        }

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => "Erreur de connexion, veuillez vérifier les informations saisies.",
                'data' => []
            ]);
        }

        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->update(['derniere_connexion' => now('Africa/Lubumbashi')]);

        return response()->json([
            'success' => true,
            'message' => "Connexion reussi",
            'data' => [
                'token' => $user->createToken('token_' . time())->plainTextToken,
                'user' => $user,
            ]
        ]);
    }

    function signup()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|min:10|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['password'] = Hash::make(request('password'));
        $data['user_role'] = 'client';
        $user =  User::create($data);
        Auth::login($user);
        return response([
            'success' => true,
            'message' => "Votre compte est créé avec succès.",
            'data' => [
                'token' => $user->createToken('token_' . time())->plainTextToken,
            ]
        ]);
    }

    public function logout()
    {
        if (Auth::check()) {
            $accessToken = request()->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);
            if ($token) {
                $token->delete();
            }
            Auth::logout();
        }
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect(route('login'));
    }
}
