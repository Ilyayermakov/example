<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Carbon\Carbon;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query();
        $materials = $query
            ->orderBy('name')
            ->get();
            $materials->transform(function ($material) {
                $material->formattedDate = Carbon::createFromFormat('Y-m-d', $material->date)->format('d.m.Y');
                return $material;
            });

        return $materials;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'date' => ['required', 'string', 'date'],
            'remainder' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'max:500'],
            'place' => ['nullable', 'string', 'max:500'],
        ]);

        $material = Material::create([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'date' => $validated['date'],
            'remainder' => $validated['remainder'],
            'description' => $validated['description'],
            'place' => $validated['place'],
        ]);

        $material->remainder = $validated['remainder'] + $validated['quantity'];

        $material->save();

        logActivity("Новая запись в таблице Материалы: $material->name");

        return $material;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'date' => ['string', 'date'],
            'remainder' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);


        $material = Material::find($id);

        $originalQuantity = $material->quantity;

        $material->update([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'date' => Carbon::createFromFormat('d.m.Y', $validated['date'])->format('Y-m-d'),
            'remainder' => $validated['remainder'],
            'description' => $validated['description'],
        ]);

        // Проверяем, изменилось ли значение quantity
        if ($originalQuantity != $validated['quantity']) {
            $material->remainder = $material->remainder + ($validated['quantity'] - $originalQuantity);
            $material->save();
        }


        logActivity("Изменение записи в таблице Материалы: $material->name");

        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $materialId = $request->input('material_id');
        $delete = Material::find($materialId);
        logActivity("Удаление из таблицы Материалы: $delete->name");
        if ($delete) {
            $delete->delete();
            return redirect()->route('table');
        } else {
            return redirect()->route('table');
        }
    }
}
