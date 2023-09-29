<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Posts\CommentController;
use Illuminate\Http\Request;

class DifferentController extends Controller
{

    // Clients

    public function indexClients(Request $request)
    {
        $clients = app(ClientController::class)->index($request);


        return view('table.clients', compact('clients'));
    }

    public function storeClients(Request $request)
    {
        $client = app(ClientController::class)->store($request);

        return redirect()->route('table.clients', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        app(ClientController::class)->update($request, $id);

        return redirect()->route('table.clients');
    }

    // Records
    public function indexRecords(Request $request)
    {
        // $recordsT = app(RecordController::class)->index($request, true);
        $recordsF = app(RecordController::class)->index($request, false);
        // $procedures = app(ProcedureController::class)->index($request);
        // $clients = app(ClientController::class)->index($request);

        // return view('table.records', compact('recordsT', 'recordsF', 'procedures', 'clients'));

        return view('table.records', compact('recordsF'));
    }

    public function indexRecordsTrue(Request $request)
    {
        $recordsT = app(RecordController::class)->index($request, true);
        $procedures = app(ProcedureController::class)->index($request);
        $clients = app(ClientController::class)->index($request);

        return view('table.index', compact('recordsT', 'procedures', 'clients'));
    }

    public function storeRecords(Request $request)
    {
        $record = app(RecordController::class)->store($request);

        return redirect()->route('table', compact('record'));
    }
    public function updateRecords(Request $request)
    {
        app(RecordController::class)->update($request);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        app(RecordController::class)->update($request);

        return redirect()->back();
    }

    public function updateRecordComment(Request $request)
    {
        app(RecordController::class)->updateRecordComment($request);

        return redirect()->back();
    }

    // Accounting
    public function indexAccounting(Request $request)
    {
        $accounting = app(AccountingController::class)->index($request);

        return view('table.accounting', compact('accounting'));
    }

    // Materials

    public function indexMaterials(Request $request)
    {
        $materials = app(MaterialController::class)->index($request);

        return view('table.materials', compact('materials'));
    }
    public function storeMaterials(Request $request)
    {
        $materials = app(MaterialController::class)->store($request);

        return redirect()->route('table.materials', compact('materials'));
    }

    public function updateMaterials(Request $request, $id)
    {
        app(MaterialController::class)->update($request, $id);

        return redirect()->route('table.materials');
    }

    // Procedures
    public function indexProcedures(Request $request)
    {
        $procedures = app(ProcedureController::class)->index($request);

        return view('table.procedures', compact('procedures'));
    }

    public function indexProceduresHome(Request $request)
    {
        $proceduresAtHome = app(ProcedureController::class)->index($request);
        $jobs = app(JobController::class)->index($request);

        return view('home.index', compact('proceduresAtHome', 'jobs'));
    }

    public function storeProcedures(Request $request)
    {
        $procedure = app(ProcedureController::class)->store($request);

        return redirect()->route('table.procedures', compact('procedure'));
    }

    public function updateProcedures(Request $request, $id)
    {
        app(ProcedureController::class)->update($request, $id);

        return redirect()->route('table.procedures');
    }

    // JOB PHOTOS
    public function storeJob(Request $request)
    {
        $job = app(JobController::class)->store($request);
        return redirect()->route('home', compact('job'));
    }

    public function deleteJob(Request $delete)
    {
        app(JobController::class)->destroy($delete);
        return redirect()->route('home');
    }
}
