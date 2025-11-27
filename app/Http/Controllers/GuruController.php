<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();

        $totalAssignments = Assignment::where('guru_id', $guruId)->count();

        $totalSubmissions = Submission::whereIn(
            'assignment_id',
            Assignment::where('guru_id', $guruId)->pluck('id')
        )->count();

        $ungraded = Submission::whereNull('grade')
            ->whereIn(
                'assignment_id',
                Assignment::where('guru_id', $guruId)->pluck('id')
            )->count();

        return view('guru.dashboard', [
            'totalAssignments' => $totalAssignments,
            'totalSubmissions' => $totalSubmissions,
            'ungraded' => $ungraded,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('guru.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('guru.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                unlink(storage_path('app/public/' . $user->photo));
            }

            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('guru.profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function assignments()
    {
        $assignments = Assignment::where('guru_id', Auth::id())->get();
        return view('guru.assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('guru.assignments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'description' => 'required',
            'deadline_date' => 'required|date',
            'deadline_time' => 'required',
        ]);

        $deadline = $request->deadline_date . ' ' . $request->deadline_time . ':00';

        Assignment::create([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $deadline,
            'guru_id'     => Auth::id(),
        ]);

        return redirect()->route('guru.assignments')->with('success', 'Tugas berhasil dibuat!');
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('guru.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'          => 'required|string',
            'description'    => 'required|string',
            'deadline_date'  => 'required|date',
            'deadline_time'  => 'required',
        ]);

        $assignment = Assignment::findOrFail($id);

        $deadline = $request->deadline_date . ' ' . $request->deadline_time . ':00';

        $assignment->update([
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $deadline,
        ]);

        return redirect()->route('guru.assignments')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Assignment::findOrFail($id)->delete();
        return back()->with('success', 'Tugas berhasil dihapus!');
    }

    public function submissions($id)
    {
        $assignment = Assignment::findOrFail($id);

        $submissions = Submission::where('assignment_id', $id)->get();

        return view('guru.assignments.submissions', compact('assignment', 'submissions'));
    }

    public function gradeSubmission(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        $submission = Submission::findOrFail($id);

        $submission->grade = $request->grade;
        $submission->save();

        return redirect()->route('guru.assignment.submissions', $submission->assignment_id)
            ->with('success', 'Nilai berhasil diberikan!');
    }

    public function gradePage($id)
    {
        $submission = Submission::findOrFail($id);
        $assignment = $submission->assignment;

        return view('guru.assignments.grade', compact('submission', 'assignment'));
    }
}
