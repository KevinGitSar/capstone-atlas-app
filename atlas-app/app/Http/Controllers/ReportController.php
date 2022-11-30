<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    // Display Report Page
    public function index($reported)
    {
        $username = auth()->user()->username;
        $reportedUser = $reported;
        
        return view('/reportpage', compact('reportedUser'))->with('username', $username);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required'],
            'reportedUser' => ['required'],
            'reason' => ['required'],
            'description' => ['required']
        ]);

        $report = new Report();

        $report->username = $formFields['username'];
        $report->reportedUser = $formFields['reportedUser'];
        $report->reason = $formFields['reason'];
        $report->description = $formFields['description'];
        $report->dateCreated = Carbon::parse(Carbon::now())->format('Y-m-d');

        $report->save();

        $message = 'Report Submitted Sucessfully!';

        return redirect('/home')->with('message', $message);

    }

    public function show($name)
    {
        $reportedUser = Report::where('reportedUser', $name)->get();
        
        return $reportedUser;
    }

    public function getAllReported()
    {
        $reports = Report::distinct()->get(['reportedUser']);
        return $reports;
    }

    public function getAllBanned()
    {
        $banned = User::onlyTrashed()->get();
        return $banned;
    }

    public function dismiss($name)
    {
        Report::where('reportedUser', $name)->delete();
    }

    public function showView()
    {
        return view('app');
    }
}
