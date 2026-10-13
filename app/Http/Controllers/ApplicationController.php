<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::paginate(5);
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room' => 'required|max:255',
            'starts_at' => 'required|date',
            'payment' => [
                'required',
                Rule::in(['При очном посещении', 'Переводом по системе СБП']),
            ],
        ]);

        $application = new Application;
        $application->room = $request->room;
        $application->starts_at = $request->starts_at;
        $application->payment = $request->payment;
        $application->user_id = Auth::id();
        $application->status = "Новая";
        $application->save();
        return redirect()->route('applications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'room' => 'max:255',
            'starts_at' => 'date',
            'payment' => [
                Rule::in(['При очном посещении', 'Переводом по системе СБП']),
            ],
        ]);
        $application->update($request->all());
        return redirect()->route('applications.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index');
    }
}
