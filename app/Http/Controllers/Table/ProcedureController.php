<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = Procedure::query();
        $procedures = $query
            ->orderBy('name')
            ->get();
            
        return $procedures;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'price' => ['required', 'numeric'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        $procedure = Procedure::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'comment' => $validated['comment'],
        ]);

        logActivity("Новая запись в таблице Процедуры: $procedure->name");

        return $procedure;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'price' => ['required', 'numeric'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);


        $procedure = Procedure::find($id);

        $procedure->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'comment' => $validated['comment'],
        ]);

        logActivity("Изменение записи в таблице Процедуры: $procedure->name");

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $procedureId = $request->input('procedure_id');
        $delete = Procedure::find($procedureId);
        logActivity("Удаление из таблицы Процедуры: $delete->name");
        if ($delete) {
            $delete->delete();
            return redirect()->route('table');
        } else {
            return redirect()->route('table');
        }
    }
}
