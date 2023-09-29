<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;

class VerificationController extends Controller
{

public function verify(Request $request)
{
    $user = User::where('id', $request->id)
                ->where('email_verified_at', null)
                ->where('active', false)
                ->first();

    if ($user) {
        $user->update([
            'active' => true,
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->to('login');
    }

    return redirect()->to('home');
}
}
