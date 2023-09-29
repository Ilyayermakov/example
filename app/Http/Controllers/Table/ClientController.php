<?php

namespace App\Http\Controllers\table;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([

            'name' => ['nullable', 'string'],
            'telephon' => ['nullable', 'string', 'regex:/^[0-9()+\- ]+$/i', 'max:50'],
        ]);

        $query = Client::query();

        if ($name = $validated['name'] ?? null) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($telephon = $validated['telephon'] ?? null) {
            $query->where('telephon', 'like', "%{$telephon}%");
        }

        $clients = $query
            ->orderBy('name')
            ->get();

        return $clients;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'telephon' => ['nullable', 'string', 'regex:/^[0-9()+\- ]+$/i', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'comment' => ['nullable', 'string', 'max:500'],
            'camefrom' => ['nullable', 'string', 'max:500'],
            'brought' => ['nullable', 'numeric'],
        ]);

        $client = Client::create([
            'name' => $validated['name'],
            'telephon' => $validated['telephon'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'camefrom' => $validated['camefrom'],
            'brought' => $validated['brought'],
        ]);

        logActivity(__('Новая запись в таблице Клиенты: ') . "$client->name");

        return $client;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'telephon' => ['nullable', 'string', 'regex:/^[0-9()+\- ]+$/i', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'comment' => ['nullable', 'string', 'max:500'],
            'camefrom' => ['nullable', 'string', 'max:500'],
            'brought' => ['nullable', 'numeric'],
        ]);


        $client = Client::find($id);

        $client->update([
            'name' => $validated['name'],
            'telephon' => $validated['telephon'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'camefrom' => $validated['camefrom'],
            'brought' => $validated['brought'],
        ]);

        logActivity(__('Изменение записи в таблице Клиенты: ') . "$client->name");

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $clientId = $request->input('client_id');
        $delete = Client::find($clientId);
        logActivity(__('Удаление из таблицы Клиенты: ') . "$delete->name");
        if ($delete) {
            $delete->delete();
            return redirect()->route('table');
        } else {
            return redirect()->route('table');
        }
    }
}
