<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Colocation $colocation)
    {
        $categories = $colocation->categories;
        $userPivot = $colocation->users()->where('user_id', Auth::id())->first()?->pivot;
        $isOwner = $userPivot && $userPivot->role === 'owner';

        return view('categories.index', compact('colocation', 'categories', 'isOwner'));
    }

    public function store(StoreCategoryRequest $request, Colocation $colocation)
    {
        $validated = $request->validated();

        $userPivot = $colocation->users()->where('user_id', Auth::id())->first()?->pivot;
        if (!$userPivot || $userPivot->left_at !== null) {
            return redirect()->back()->withErrors(['error' => 'Seuls les membres actifs peuvent créer des catégories.']);
        }

        Category::create([
            'name' => $validated['name'],
            'colocation_id' => $colocation->id
        ]);

        return redirect()->back()->with('success', 'Catégorie créée avec succès.');
    }

    public function destroy(Colocation $colocation, Category $category)
    {
        if ($category->colocation_id !== $colocation->id) {
            abort(403);
        }
        $category->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
