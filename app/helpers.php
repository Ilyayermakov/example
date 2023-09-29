<?php

use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if (!function_exists('test')) {
    function test()
    {
        return app('test');
    }
}

if (!function_exists('active_link')) {
    function active_link(string $name, string $active = 'active'): string
    {
        return Route::is($name) ? $active : '';
    }
}

if (!function_exists('alert')) {
    function alert(string $value)
    {
        session(['alert' => $value]);
    }
}

if (!function_exists('validate')) {
    function validate(array $attributes, array $rules): array
    {
        return validator($attributes, $rules)->validate();
    }
}

if (!function_exists('totalPrice')) {
    function totalPrice($tableName, $columnsName, $fromdate = null, $todate = null)
    {
        $query = DB::table($tableName);

        if ($fromdate !== null) {
            $query->where('date', '>=', $fromdate);
        }

        if ($todate !== null) {
            $query->where('date', '<=', $todate);
        }

        $totalPrice = $query->select(DB::raw('SUM(' . implode(' * ', $columnsName) . ') as total'))->value('total');

        return $totalPrice;
    }
}

if (!function_exists('totalPriceRecord')) {
    function totalPriceRecord($columnsName, $trueorfalse, $profile_id = null)
    {
        $query = DB::table('records')
            ->where('active', $trueorfalse);

        if ($profile_id !== null) {
            $query->where('profile_id', $profile_id);
        }

        $totalPriceRecord = $query->select(DB::raw('SUM(' . implode(' * ', $columnsName) . ') as total'))
            ->value('total');

        return $totalPriceRecord;
    }
}

function totalPriceRecordDate($columnsName, $trueorfalse, $fromdate = null, $todate = null)
{
    $query = DB::table('records')
        ->where('active', $trueorfalse);

    if ($fromdate !== null) {
        $query->where('date', '>=', new Carbon($fromdate));
    }

    if ($todate !== null) {
        $query->where('date', '<=', new Carbon($todate));
    }

    $totalPriceRecord = $query->select(DB::raw('SUM(' . implode(' + ', $columnsName) . ') as total'))
        ->value('total');

    return $totalPriceRecord;
}

if (!function_exists('countRecord')) {
    function countRecord($columnsName, $trueorfalse, $profile_id)
    {
        $countRecord = DB::table('records')
            ->where('active', $trueorfalse)
            ->where('profile_id', $profile_id)
            ->select(DB::raw('COUNT(' . implode($columnsName) . ') as total'))
            ->value('total');

        return $countRecord;
    }
}

if (!function_exists('countRecordDate')) {
    function countRecordDate($columnsName, $trueorfalse, $profile_id)
    {
        $countRecordDate = DB::table('records')
            ->where('active', $trueorfalse)
            ->where('profile_id', $profile_id)
            ->select(DB::raw('COUNT( DISTINCT ' . implode($columnsName) . ') as total'))
            ->value('total');

        return $countRecordDate;
    }
}

if (!function_exists('totalPriceProfileId')) {
    function totalPriceProfileId($tableName, $columnsName, $profile_id)
    {
        $totalPriceProfileId = DB::table($tableName)
            ->where('profile_id', $profile_id)
            ->select(DB::raw('SUM(' . implode(' * ', $columnsName) . ') as total'))
            ->value('total');

        return $totalPriceProfileId;
    }
}

if (!function_exists('logActivity')) {
    function logActivity($activity)
    {
        $user = Auth::user();

        if ($user && $user->id && $user->name && $activity) {
            UserActivity::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'activity' => $activity
            ]);
        }
    }
}
