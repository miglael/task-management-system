<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    // Dashboard murid → daftar assignment
    public function index()
    {
        $assignments = Assignment::all();
        return view('murid.assignments.index', compact('assignments'));
    }

    // Form submit tugas
    public function submit($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('murid.assignments.submit', compact('assignment'));
    }

    // Simpan submission murid
    public function storeSubmission(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:5000'
        ]);

        $path = $request->file('file')->store('submissions');

        Submission::create([
            'assignment_id' => $id,
            'murid_id' => Auth::id(),
            'file_path' => $path,
            'submitted_at' => now(),
        ]);

        return redirect()->route('murid.assignments')->with('success', 'Tugas berhasil dikumpulkan');
    }

    // Lihat nilai tugas yang sudah dikumpulkan
    public function mySubmissions()
    {
        $submissions = Submission::where('murid_id', Auth::id())->get();
        return view('murid.assignments.mysubmissions', compact('submissions'));
    }
}
