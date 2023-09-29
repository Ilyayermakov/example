<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('login.password_reset');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:50', 'email'],
            // 'g-recaptcha-response' => ['required'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            if ($user->isActive()) {
                $password = $user->password;

                $code = mt_rand(000000, 999999);
                $user = User::find($user->id);
                $user->code = $code;
                $user->save();

                $emailData = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id,
                    'code' => $user->code,
                    'hash' => sha1($user->password),
                ];

                Mail::send('emails.password_forgot', $emailData, function ($message) use ($emailData) {
                    $message->to($emailData['email'], $emailData['name'], $emailData['code'])
                        ->subject(__('Забыли пароль'));
                });

                session()->flash('user', $user);

                return Redirect::action('App\Http\Controllers\Auth\ForgotPasswordController@redirectToMessage');
            }
            return redirect()->back()->withErrors('Your user is blocked');
        }

        return redirect()->back()->withErrors('Пользователь с таким email не найден.');
    }

    public function redirectToMessage()
    {
        $user = session('user');

        if ($user && $user->name && $user->email) {
            return view('register.message_password', [
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } else {
            return redirect('home');
        }
    }




    public function passwordChange(Request $request)
    {
        $user = User::where('id', $request->id)
            ->whereNotNull('email_verified_at')
            ->whereNotNull('code')
            ->where('active', true)
            ->first();

        if ($user) {
            session()->flash('user', $user);
            return view('change.change_password');
        } else {
            return redirect('home');
        }
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'new_password' => ['string', 'min:7', 'max:50'],
        'password_confirmation' => ['same:new_password'],
        'code' => ['numeric']
    ]);

    $user = session('user');

    if ($user) {

        if ($request->code == $user->code) {

            $user->password = Hash::make($request->input('new_password'));
            $user->code = null;
            $user->save();

            return view('login.index');

        } else {
            return redirect()->back()->withErrors('Неверный код.');
        }
    } else {
        return redirect('home');
    }
}

}
