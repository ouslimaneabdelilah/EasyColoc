<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Settlement;

class AdminDashboardController extends Controller
{
    public function stats()
    {
        $stats = [
            'total_users' => User::count(),
            'total_colocations' => Colocation::count(),
            'active_colocations' => Colocation::where('status', 'active')->count(),
            'total_expenses' => Expense::sum('amount'),
            'banned_users' => User::where('status', 'banned')->count() ?? 0,
        ];
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.stats', compact('stats', 'users'));
    }

    public function banUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->withErrors(['error' => 'Cannot ban an admin']);
        }

        $user->status = 'banned';
        $user->save();

        return redirect()->back()->with('success', 'User banned successfully');
    }

    public function unbanUser(User $user)
    {
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'User unbanned successfully');
    }
}
