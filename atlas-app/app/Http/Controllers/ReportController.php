<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the report page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($reported)
    {
        $username = auth()->user()->username;
        $reportedUser = $reported;
        
        return view('/reportpage', compact('reportedUser'))->with('username', $username);
    }

    /**
     * Create and store a report.
     *
     * @return \Illuminate\Http\Request
     */
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

    /**
     * Display a reported user.
     *
     */
    public function show($name)
    {
        $reportedUser = Report::where('reportedUser', $name)->get();
        
        return $reportedUser;
    }

    /**
     * Display all reported users.
     *
     * @return \App\Models\Report
     */
    public function getAllReported()
    {
        $reports = Report::distinct()->get(['reportedUser']);
        return $reports;
    }

    /**
     * Display all banned users.
     *
     * @return \App\Models\User
     */
    public function getAllBanned()
    {
        $banned = User::onlyTrashed()->get();
        return $banned;
    }

    /**
     * Deletes all reports of a user.
     *
     */
    public function dismiss($name)
    {
        Report::where('reportedUser', $name)->forceDelete();
    }

    /**
     * Display the admin view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showView()
    {
        return view('app');
    }
}
