<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    // Dashboard Guru: daftar assignment yang dia buat
    public function index()
    {
        $assignments = Assignment::where('guru_id', Auth::id())->get();
        return view('guru.assignments.index', compact('assignments'));
    }

    // Form create assignment
    public function create()
    {
        return view('guru.assignments.create');
    }

    // Simpan assignment baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ]);

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'guru_id' => Auth::id(),
        ]);

        return redirect()->route('guru.assignments')->with('success', 'Tugas berhasil dibuat');
    }

    // Edit Assignment
    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('guru.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ]);

        $assignment = Assignment::findOrFail($id);

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.assignments')->with('success', 'Tugas berhasil diperbarui');
    }

    // Hapus assignment
    public function destroy($id)
    {
        Assignment::findOrFail($id)->delete();
        return redirect()->back();
    }

    // Melihat submissions untuk satu assignment
    public function submissions($id)
    {
        $assignment = Assignment::findOrFail($id);
        $submissions = $assignment->submissions;

        return view('guru.assignments.submissions', compact('assignment', 'submissions'));
    }

    // Memberi nilai & feedback
    public function gradeSubmission(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|integer',
            'feedback' => 'nullable|string'
        ]);

        $submission = Submission::findOrFail($id);

        $submission->update([
            'grade' => $request->grade,
            'feedback' => $request->feedback,
        ]);

        return back()->with('success', 'Nilai berhasil diberikan');
    }
}
