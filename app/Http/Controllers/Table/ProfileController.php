<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Material;
use App\Models\Procedure;
use App\Models\Record;
use App\Models\Spent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ProfileController extends Controller
{

    public function indexProfile(Request $request)
    {

        $profile_id = $request->route('profile_id');
        $query = Client::query();
        $client = $query
            ->where('id', $profile_id)
            ->first();

        $query = Record::query();
        $recordT = $query
            ->where('profile_id', $profile_id)
            ->where('active', true)
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $query = Record::query();

        $recordT->transform(function ($record) {
            $record->date = Carbon::parse($record->date)->format('d.m.Y');
            $record->time = Carbon::parse($record->time)->format('H:i');
            return $record;
        });

        $recordF = $query
            ->where('profile_id', $profile_id)
            ->where('active', false)
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->get();

        $recordF->transform(function ($record) {
            $record->date = Carbon::parse($record->date)->format('d.m.Y');
            $record->time = Carbon::parse($record->time)->format('H:i');
            return $record;
        });

        $query = Procedure::query();
        $procedures = $query
            ->orderBy('name')
            ->get();

        $query = Material::query();
        $materials = $query
            ->orderBy('name')
            ->get();

        $query = Spent::query();
        $spents = $query
            ->where('profile_id', $profile_id)
            ->orderBy('date')
            ->get();

        $spents->transform(function ($spent) {
            $spent->date = Carbon::parse($spent->date)->format('d.m.Y');
            return $spent;
        });

        return view('table.profile', compact('client', 'recordT', 'recordF', 'procedures', 'materials', 'spents'));
    }

    public function storeRecordProfile(Request $request)
    {
        $request->validate([
            'date' => 'date',
            'time' => 'date_format:H:i',
            'discount' => 'numeric',
            'profile_id' => 'numeric',
        ]);

        $record = new Record();
        $record->date = $request->input('date');
        $record->time = $request->input('time');
        $record->discount = $request->input('discount');
        $record->profile_id = $request->route('profile_id');

        $record->procedure = $request->input('procedure_name');
        $procedureName = $request->input('procedure_name');
        $procedure = Procedure::where('name', $procedureName)->first();
        $record->price = $procedure->price;

        $clientId = $record->profile_id;

        $existingClient = Client::find($clientId);

        if ($existingClient) {
            $record->name = $existingClient->name;
            $record->telephon = $existingClient->telephon;
            $record->email = $existingClient->email;
        }
        $record->save();

        logActivity("Новая запись в таблице Записи: $record->name $record->date $record->time $record->procedure");

        return $record;
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
        $profile_id = $client->id;
        $client->update([
            'name' => $validated['name'],
            'telephon' => $validated['telephon'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'camefrom' => $validated['camefrom'],
            'brought' => $validated['brought'],
        ]);

        logActivity("Изменение в таблице Клиенты: $client->name");

        return redirect()->back();
    }
}
