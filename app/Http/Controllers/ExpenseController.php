<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

use App\Models\Colocation;

class ExpenseController extends Controller
{
        public function index(Request $request, Colocation $colocation)
    {
        $user = Auth::user();

        $userPivot = $colocation->users()->where('user_id', $user->id)->first()?->pivot;
        if (!$userPivot) {
            return redirect()->back()->withErrors(['error' => 'Accès non autorisé.']);
        }

        $query = $colocation->expenses()->with(['category', 'payer']);

        if ($request->has('month')) {
            $month = $request->input('month');
            $query->whereMonth('expense_date', substr($month, 5, 2))
                ->whereYear('expense_date', substr($month, 0, 4));
        }

        $expenses = $query->orderBy('expense_date', 'desc')->get();
        $isOwner = $userPivot->role === 'owner';

        return view('expenses.index', compact('colocation', 'expenses', 'isOwner'));
    }
    public function create()
    {
       
    }

    public function store(Request $request)
    {
        
    }

    public function show(Expense $expense)
    {
    }
}
