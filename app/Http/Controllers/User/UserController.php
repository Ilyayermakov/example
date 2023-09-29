<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            return view('change.index', ['user' => $user]);
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:500'],
            'name' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'max:50', 'email', 'unique:users,email,' . Auth::id()],
            'password' => ['nullable', 'string', 'min:7', 'max:50'],
            'new_password' => ['nullable', 'string', 'min:7', 'max:50'],
            'password_confirmation' => ['nullable', 'same:new_password'],
        ]);

        $user = Auth::user();


        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('', 'avatars');
            $user->avatar = $avatarPath;
        }


        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }


        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }


        if ($request->filled('password')) {
            if (Hash::check($request->input('password'), $user->password)) {

                $user->password = Hash::make($request->input('new_password'));
            } else {

                return redirect()->back()->with('alert', 'Old password is incorrect.');
            }
        }

        $user->save();

        return redirect()->route('change')->with('alert', __('Изменения вступили в силу'));
    }

    public function indexUsers(Request $request)
    {
        $query = User::query();
        $users = $query
            ->orderByDesc('active')
            ->orderBy('name')
            ->get();

        $activities = UserActivity::latest()->get();

        $comments = Comment::query()
            ->orderByDesc('created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('comments.*', 'users.name as user_name', 'posts.title as post_title')
            ->get();

            foreach ($comments as $comment) {
                $comment->formatted_created_at = $comment->created_at->format('d.m.Y H:i');
            }

        return view('change.admin', compact('users', 'activities', 'comments'));
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'active' => ['nullable', 'boolean', 'in:0,1', 'max:1'],
            'admin' => ['nullable', 'boolean', 'in:0,1', 'max:1'],
        ]);

        $user = User::find($id);
        $user->update([
            'active' => $validated['active'],
            'admin' => $validated['admin'],
        ]);
        $user->save();

        logActivity(__('Изменение записи в таблице') . "User: id = $user->id," . __('Имя') . ": $user->name");

        return redirect()->back();
    }

    public function deleteActivity(Request $request)
    {
        $userAct = $request->input('userAct');
        $delete = UserActivity::find($userAct);
        if ($delete) {
            $delete->delete();
            return redirect()->route('change.admin');
        } else {
            return redirect()->route('change.admin');
        }
    }

    public function deleteAll()
    {
        UserActivity::truncate();

        return redirect()->back();
    }
}
