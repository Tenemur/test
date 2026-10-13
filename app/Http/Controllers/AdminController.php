<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $applications = Application::paginate(5);
        return view('admin', compact('applications'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => [
                Rule::in(['Мероприятие назначено', 'Завершено']),
            ],
        ]);
        $application->update($request->all());
        return redirect()->route('admin.index');
    }
}
