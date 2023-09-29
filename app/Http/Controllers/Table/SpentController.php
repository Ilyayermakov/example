<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Spent;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'date',
            'quantity' => 'numeric',
            'name' => 'string',
            'price' => 'numeric',
            'profile_id' => 'numeric',
        ]);

        $spent = new Spent();
        $spent->date = $request->input('date');
        $spent->quantity = $request->input('quantity');
        $spent->profile_id = $request->route('profile_id');
        $spent->name = $request->input('material_name');

        $materialName = $request->input('material_name');

        $material = Material::where('name', $materialName)->first();
        $spent->price = $spent->quantity * $material->price;
        $material->remainder = $material->remainder - $spent->quantity;
        $material->save();

        $spent->save();

        logActivity("Новая запись в Профайле $spent->profile_id таблице Потраченные Материалы: $spent->date $spent->name $spent->quantity ");

        return $spent;
    }

    public function destroy(Request $request)
    {
        $spentId = $request->input('spent_id');
        $delete = Spent::find($spentId);
        logActivity("Удаление из Профайла  $delete->profile_id таблицы Потраченые Материалы: $delete->date $delete->name $delete->quantity");
        if ($delete) {
            $delete->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
