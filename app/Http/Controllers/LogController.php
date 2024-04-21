<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        try {
            $logs = Log::orderByDesc('created_at')->paginate(30);
            return view('admin.log.index', compact('logs'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
    public function userLog($id)
    {
        try {
            $uLogs = Log::where('user_id', $id)->orderByDesc('created_at')->paginate(30);
            $user = User::find($id);
            return view('admin.log.ulog', compact('uLogs', 'user'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('infoMsg', $th->getMessage());
        }
    }
}
