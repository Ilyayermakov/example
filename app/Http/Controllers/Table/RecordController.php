<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Procedure;
use App\Models\Record;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function index(Request $request, $active = null)
    {

        $validated = $request->validate([

            'first_date' => ['nullable', 'string', 'date'],
            'last_date' => ['nullable', 'string', 'date', 'after_or_equal:first_date'],
            'name' => ['nullable', 'string'],
            'procedure' => ['nullable', 'string'],
        ]);

        $query = Record::query();

        if ($fromdate = $validated['first_date'] ?? null) {
            $query->where('date', '>=', new Carbon($fromdate));
        }
        if ($todate = $validated['last_date'] ?? null) {
            $query->where('date', '<=', new Carbon($todate));
        }
        if ($name = $validated['name'] ?? null) {
            $query->where('name', 'like', "%{$name}%");
        }
        if ($procedure = $validated['procedure'] ?? null) {
            $query->where('procedure', 'like', "%{$procedure}%");
        }

        if ($active !== null) {
            $query->where('active', $active);
        }

        $records = $query
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $records->transform(function ($record) {
            $record->date = Carbon::parse($record->date)->format('d.m.Y');
            $record->time = Carbon::parse($record->time)->format('H:i');
            return $record;
        });

        return $records;
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'date',
            'time' => 'date_format:H:i',
            'discount' => 'numeric'
        ]);

        $record = new Record();
        $record->date = $request->input('date');
        $record->time = $request->input('time');
        $record->discount = $request->input('discount');

        $record->procedure = $request->input('procedure_name');
        $procedureName = $request->input('procedure_name');
        $procedure = Procedure::where('name', $procedureName)->first();
        $record->price = $procedure->price;

        $record->name = $request->input('client_name');
        $clientName = $request->input('client_name');
        $existingClient = Client::where('name', $clientName)->first();
        $record->profile_id = $existingClient->id;
        $record->telephon = $existingClient->telephon;
        $record->email = $existingClient->email;

        $record->save();

        logActivity("Новая запись в таблице Записи: $record->name $record->date $record->time $record->procedure");

        return redirect()->route('table');
    }

    public function update(Request $request)
    {
        $recordId = $request->input('record_id');
        $record = Record::find($recordId);

        if ($record) {
            $record->active = !$record->active;
            $record->save();
        }

        logActivity("Перенос из таблицы Записи в таблицу Прошлые Записи: $record->name $record->date $record->time $record->procedure");

        return redirect()->route('table');
    }

    public function updateRecordComment(Request $request)
    {
        $validated = $request->validate([
            'comment' => ['nullable', 'string'],
        ]);

        $recordId = $request->input('record_id');
        $record = Record::find($recordId);

        if ($record) {
            $record->update([
                'comment' => $validated['comment'],
            ]);

            logActivity("Изменение записи в таблице Прошлые Записи: {$record->comment}");

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $recordId = $request->input('record_id');

        $record = Record::find($recordId);
        logActivity("Удаление из таблицы Записи/Прошлые Записи: $record->name $record->date $record->time $record->procedure");

        $delete = Record::find($recordId);
        if ($delete) {
            $delete->delete();
            return redirect()->route('table');
        } else {
            return redirect()->route('table');
        }
    }
}
