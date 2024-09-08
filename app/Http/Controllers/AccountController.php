<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAccount(Request $request)
    {
        $getUser = User::find($request->id ?? 0);
        $headers = [
            'Content-Type' => 'application/json',
            'charset' => 'utf-8',
        ];

        if (!$getUser) {
            return response()->json(['message' => 'User not found'], 404, $headers);
        }

        return response()->json($getUser, 200, $headers);
    }
}
