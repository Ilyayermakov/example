<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'first_date' => ['nullable', 'string', 'date'],
            'last_date' => ['nullable', 'string', 'date', 'after_or_equal:first_date'],
        ]);

        $first_date = $validated['first_date'] ?? null;
        $last_date = $validated['last_date'] ?? null;

        $subquery = DB::table('spents')
            ->select('date', 'profile_id', DB::raw('SUM(price) AS total_rashod'))
            ->groupBy('date', 'profile_id');

        if ($first_date !== null) {
            $subquery->where('date', '>=', $first_date);
        }

        if ($last_date !== null) {
            $subquery->where('date', '<=', $last_date);
        }


        $query = DB::table('records')
            ->where('active', false)
            ->leftJoinSub($subquery, 'spents', function ($join) {
                $join->on('spents.date', '=', 'records.date')
                    ->on('spents.profile_id', '=', 'records.profile_id');
            })
            ->select('records.date', 'records.name', 'records.price', 'records.discount', 'records.profile_id')
            ->selectRaw('records.price - records.discount AS total_dohod')
            ->selectRaw('COALESCE(total_rashod, 0) AS total_rashod')
            ->selectRaw('(records.price - records.discount) - COALESCE(total_rashod, 0) AS total_pribl')
            ->groupBy('records.date', 'records.name', 'records.profile_id', 'records.price', 'records.discount')
            ->orderBy('records.date', 'ASC');

        if ($first_date !== null) {
            $query->where('records.date', '>=', $first_date);
        }

        if ($last_date !== null) {
            $query->where('records.date', '<=', $last_date);
        }

        $accounbydate = $query->get();

        return $accounbydate;
    }
}
