<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Rules\CustomPasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-access', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Visited user index page',
                'user_id' => auth()->id(),
            ]);
            $users = User::latest()->get();
            return view('admin.user.index', compact('users'));
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error visiting user index page: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        try {
            // Log the action
            $roles = Role::pluck('name');
            Log::create([
                'action' => 'Visited create user page',
                'user_id' => auth()->id(),
            ]);
            return view('admin.user.create', compact('roles'));
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error visiting create user page: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Log the action
            $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => [new CustomPasswordRule],
                'role' => ['required'],
            ]);

            $userAttributes = [
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            $user = User::create($userAttributes);
            $user->assignRole($request->role);

            Log::create([
                'action' => 'Attempted to store a new user ' . $user->first_name,
                'user_id' => auth()->id(),
            ]);
            return redirect()->route('admin.users')->with('success', 'ተጠቃሚ ተመዝግቧል');
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error storing a new user: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Visited edit user page',
                'user_id' => auth()->id(),
            ]);

            return view('admin.user.edit', compact('user'));
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error visiting edit user page: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function profile()
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Visited profile edit page',
                'user_id' => auth()->id(),
            ]);

            return view('admin.user.profile');
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error visiting profile edit page: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function password()
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Visited password change page',
                'user_id' => auth()->id(),
            ]);

            return view('admin.user.password');
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error visiting password change page: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Attempted to update a user',
                'user_id' => auth()->id(),
            ]);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => [new CustomPasswordRule],
                'role' => ['required', 'in:admin,encoder,drawer'],
            ]);

            $user->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
                'profile_img' => $request->input('profile_img'),
            ]);

            return redirect()->route('admin.users')->with('success', 'ተጠቃሚ ዘምኗል');
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error updating a user: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            // Log the action
            Log::create([
                'action' => 'Attempted to delete a user',
                'user_id' => auth()->id(),
            ]);

            $user->delete();
            return redirect()->route('users.index')->with('success', 'ተጠቃሚ ተሰርዟል');
        } catch (\Throwable $e) {
            Log::create([
                'action' => 'Error deleting a user: ' . $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function changepassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with('errorMsg', 'የአሁኑ የይለፍ ቃልዎ ካስገቡት የይለፍ ቃል ጋር አይዛመድም። እባክዎ ዳግም ይሞክሩ!');
            }

            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with('errorMsg', 'አዲስ የይለፍ ቃል አሁን ካለው የይለፍ ቃል ጋር አንድ አይነት ሊሆን አይችልም። እባክዎ የተለየ የይለፍ ቃል ይምረጡ።');
            }

            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with('success', 'የይለፍ ቃል ተቀይሯል!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
