<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Expenses\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function create(Colocation $colocation)
    {
        $categories = $colocation->categories;
        $users = $colocation->users()->wherePivotNull('left_at')->get();
        return view('expenses.create', compact('colocation', 'categories', 'users'));
    }

    public function store(StoreExpenseRequest $request, Colocation $colocation)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $userPivot = $colocation->users()->where('user_id', $user->id)->first()?->pivot;
        if (!$userPivot || $userPivot->left_at !== null) {
            return redirect()->back()->withErrors(['error' => 'Vous n\'êtes pas un membre actif de cette colocation.']);
        }

        DB::beginTransaction();
        try {
            $expense = Expense::create([
                'title' => $validated['title'],
                'amount' => $validated['amount'],
                'expense_date' => $validated['expense_date'],
                'status' => 'pending',
                'category_id' => $validated['category_id'],
                'paid_by' => $validated['paid_by'],
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->route('expenses.show', ['colocation' => $colocation, 'expense' => $expense])->with('success', 'Dépense créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Échec de la création de la dépense.']);
        }
    }

    public function show(Expense $expense)
    {
      
    }
}
