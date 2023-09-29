<?php

namespace App\Http\Controllers\table;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Table\AccountingController;
use App\Http\Controllers\Table\RecordController;
use App\Http\Controllers\Table\ClientController;
use App\Http\Controllers\Table\MaterialController;
use App\Http\Controllers\Table\ProcedureController;
use App\Http\Controllers\Table\ProfileController;
use App\Http\Controllers\Table\SpentController;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombinedController extends Controller
{

    // INDEX table
    // public function index(Request $request)
    // {
    //     $trueRecords = app(RecordController::class)->index($request, true);
    //     // $falseRecords = app(RecordController::class)->index($request, false);
    //     $clients = app(ClientController::class)->index($request);
    //     $materials = app(MaterialController::class)->index($request);
    //     $procedures = app(ProcedureController::class)->index($request);
    //     // $accounbydate = app(AccountingController::class)->index($request);

    //     return view('table.index', compact('trueRecords', 'clients', 'materials', 'procedures'));
    // }

    // Client

    // public function store(Request $request)
    // {
    //     $client = app(ClientController::class)->store($request);

    //     return redirect()->route('table', compact('client'));
    // }

    // public function updateClient(Request $request, $id)
    // {
    //     app(ClientController::class)->update($request, $id);

    //     return redirect()->route('table');
    // }

    //  Record

    // public function storeRecord(Request $request)
    // {
    //     $record = app(RecordController::class)->store($request);

    //     return redirect()->route('table', compact('record'));
    // }

    // public function update(Request $request)
    // {
    //     app(RecordController::class)->update($request);

    //     return redirect()->back();
    // }

    // Material

    // public function storeMaterial(Request $request)
    // {
    //     $material = app(MaterialController::class)->store($request);

    //     return redirect()->route('table', compact('material'));
    // }

    // public function updateMaterial(Request $request, $id)
    // {
    //     app(MaterialController::class)->update($request, $id);

    //     return redirect()->route('table');
    // }

    // Procedure

    // public function storeProcedure(Request $request)
    // {
    //     $procedure = app(ProcedureController::class)->store($request);

    //     return redirect()->route('table', compact('procedure'));
    // }

    // public function updateProcedure(Request $request, $id)
    // {
    //     app(ProcedureController::class)->update($request, $id);

    //     return redirect()->route('table');
    // }

    // Profile

    public function storeRecordProfile(Request $request)
    {
        $records = app(ProfileController::class)->storeRecordProfile($request);

        return redirect()->back();
    }
    public function updateClientProfile(Request $request, $id)
    {
        $client = app(ProfileController::class)->update($request, $id);

        return redirect()->back();
    }

    // Spent

    public function storeSpent(Request $request)
    {
        $spent = app(SpentController::class)->store($request);

        return redirect()->back();
    }


    // Delete

    // public function delete(Request $delete)
    // {
    //     app(ClientController::class)->destroy($delete);
    //     app(RecordController::class)->destroy($delete);
    //     app(MaterialController::class)->destroy($delete);
    //     app(ProcedureController::class)->destroy($delete);
    //     app(SpentController::class)->destroy($delete);
    //     return redirect()->back();
    // }

    public function deleteClient(Request $delete)
    {
        app(ClientController::class)->destroy($delete);

        return redirect()->back();
    }

    public function deleteRecord(Request $delete)
    {
        app(RecordController::class)->destroy($delete);

        return redirect()->back();
    }

    public function deleteMaterial(Request $delete)
    {
        app(MaterialController::class)->destroy($delete);

        return redirect()->back();
    }

    public function deleteProcedure(Request $delete)
    {
        app(ProcedureController::class)->destroy($delete);

        return redirect()->back();
    }

    public function deleteSpent(Request $delete)
    {

        app(SpentController::class)->destroy($delete);

        return redirect()->back();
    }

    //Accountig

    // public function periodAccountig(Request $request)
    // {
    //     $accountig = app(AccountingController::class)->index($request);

    //     return redirect()->back();
    // }

}
