<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:50', 'confirmed'],
            'agreement' => ['accepted'],
            // 'g-recaptcha-response' => ['required'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $emailData = [
            'name' => $user->name,
            'email' => $user->email,
            'id' => $user->id,
            'hash' => sha1($user->email),
        ];

        Mail::send('emails.confirmation', $emailData, function ($message) use ($emailData) {
            $message->to($emailData['email'], $emailData['name'])
                ->subject(__('Подтверждение регистрации'));
        });

        session()->flash('user', $user);

        return Redirect::action('App\Http\Controllers\RegisterController@redirectToMessage');
    }

    public function redirectToMessage()
{
    $user = session('user');

    if ($user && $user->name && $user->email) {
        return view('register.message', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    } else {
        return redirect('/');
    }
}
}
