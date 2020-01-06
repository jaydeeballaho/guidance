<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function getAccountDetails()
    {
        $account = auth()->user();

        switch($account->role){
            case 1:
                $role_details = $account->counsel()->first();
                break;
            case 2:
                $role_details = $account->student()->first();
                break;
            default:
                $role_details = null;
                break;
        }
        return view('my_account')
                    ->with('account', $account)
                    ->with('role_details', $role_details);
    }

    public function editAccountDetails(Request $request)
    {
        switch(auth()->user()->role)
        {
            case 1:
                auth()->user()->counsel()->first()->update($request->only(['lastName', 'firstName', 'middleName', 'extName']));
                break;
            case 2:
                auth()->user()->student()->first()->update($request->only(['lastName', 'firstName', 'middleName', 'extName']));
                break;
        }
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => 'Updated account',
            'rating' => 3,
        ]);
        
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        $validator->after(function ($validator) use($request) {
            if (!Hash::check($request->currentPassword, auth()->user()->password)) {
                $validator->errors()->add('currentPassword', 'This password does not match with our records.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            auth()->user()->password = Hash::make($request->password);
            Log::create([
                'user_id' => auth()->user()->id,
                'message' => 'Password changed.',
                'rating' => 2,
            ]);
            auth()->user()->save();
            auth()->logout();

            return redirect()->back();
        }
    }
}
