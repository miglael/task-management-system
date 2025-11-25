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
        $assignments = Assignment::orderBy('deadline', 'asc')->get();
        return view('murid.assignments.index', compact('assignments'));
    }
    public function dashboard()
    {
        $muridId = auth()->id();

        $totalAssignments = Assignment::count();

        $submitted = Submission::where('murid_id', $muridId)->count();

        $pending = $totalAssignments - $submitted;

        return view('murid.dashboard', [
            'totalAssignments' => $totalAssignments,
            'submitted' => $submitted,
            'pending' => $pending,
        ]);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('murid.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('murid.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update basic data
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        // Upload file
        if ($request->hasFile('photo')) {

            // Hapus foto lama jika ada
            if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                unlink(storage_path('app/public/' . $user->photo));
            }

            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('murid.profile')->with('success', 'Profil berhasil diperbarui');
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
