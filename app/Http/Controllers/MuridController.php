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
        // $muridId = auth()->id();
        $muridId = Auth::id();

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
        // $user = auth()->user();
        $user = Auth::user();
        return view('murid.profile', compact('user'));
    }

    public function editProfile()
    {
        // $user = auth()->user();
        $user = Auth::user();
        return view('murid.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // $user = auth()->user();
        /** @var \App\Models\User $user */
        $user = Auth::user();

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

    public function editSubmission($id)
    {
        $assignment = Assignment::findOrFail($id);

        $submission = Submission::where('assignment_id', $id)
            ->where('murid_id', Auth::id())
            ->firstOrFail();

        return view('murid.assignments.edit', compact('assignment', 'submission'));
    }

    public function updateSubmission(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:5000'
        ]);

        $submission = Submission::where('assignment_id', $id)
            ->where('murid_id', Auth::id())
            ->firstOrFail();

        // Hapus file lama
        if ($submission->file_path && file_exists(storage_path('app/' . $submission->file_path))) {
            unlink(storage_path('app/' . $submission->file_path));
        }

        // Upload baru
        $submission->file_path = $request->file('file')->store('submissions', 'public');
        $submission->submitted_at = now();
        $submission->save();

        return redirect()->route('murid.assignments')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    public function deleteSubmission($id)
    {
        $submission = Submission::where('assignment_id', $id)
            ->where('murid_id', Auth::id())
            ->firstOrFail();

        // Path yang benar untuk disk 'public'
        $filePath = storage_path('app/public/' . $submission->file_path);

        // Hapus file jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus record dari database
        $submission->delete();

        return redirect()->route('murid.assignments')
            ->with('success', 'Submission berhasil dihapus!');
    }



    // Simpan submission murid
    public function storeSubmission(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:5000'
        ]);

        $path = $request->file('file')->store('submissions', 'public');

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
