<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Colocations\StoreColocationRequest;
use App\Models\Colocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class ColocationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $colocations = $user->colocations()->withPivot('role', 'left_at')->get();
        return view('colocations.index', compact('colocations'));
    }

    public function create()
    {
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();

        if ($user->activeMemberships()) {
            return redirect()->back()->withErrors(['error' => 'Vous avez déjà une colocation active.']);
        }

        DB::beginTransaction();
        try {
            $colocation = Colocation::create([
                'name' => $validated['name'],
                'status' => 'active',
            ]);

            $user->colocations()->attach($colocation->id, [
                'id' => (string) Str::uuid(),
                'role' => 'owner',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'La colocation a été créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Échec de la création de la colocation.']);
        }
    }

    public function show(Colocation $colocation)
    {
        $users = $colocation->users()->get();

        $currentUserPivot = $colocation->users()->where('user_id', Auth::id())->first()?->pivot;
        $isOwner = $currentUserPivot && $currentUserPivot->role === 'owner';

        $balances = $colocation->calculateBalances();

        return view('colocations.show', compact('colocation', 'users', 'isOwner', 'currentUserPivot', 'balances'));
    }

    public function cancel(Colocation $colocation)
    {
        $this->authorize('cancel', $colocation);

        $activeCount = $colocation->users()->wherePivotNull('left_at')->count();
        if ($activeCount > 1) {
            return redirect()->back()->withErrors(['error' => 'Vous ne pouvez pas annuler la colocation tant que vous n\'êtes pas le dernier membre actif. Veuillez d\'abord retirer les autres membres.']);
        }

        DB::beginTransaction();
        try {
            $colocation->update(['status' => 'cancelled']);

            $balances = $colocation->calculateBalances();

            foreach ($colocation->users as $member) {
                $balance = $balances[$member->id] ?? 0;
                $statusModifier = $balance < 0 ? -1 : 1;
                $member->increment('reputation', $statusModifier);
            }

            $colocation->delete();
            DB::commit();

            return redirect()->route('colocations.index')->with('success', 'La colocation a été annulée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Échec de l\'annulation de la colocation.']);
        }
    }

    public function removeMember(Colocation $colocation, User $member)
    {
        $user = Auth::user();

        $actionUser = $colocation->users()->where('user_id', $user->id)->first();
        $isOwner = $actionUser && $actionUser->pivot->role === 'owner';
        $isSelf = $member->id === $user->id;

        if (!$isOwner && !$isSelf) {
            return redirect()->back()->withErrors(['error' => 'Action non autorisée.']);
        }

        if ($isOwner && $isSelf) {
            return redirect()->back()->withErrors(['error' => 'Le propriétaire ne peut pas quitter, il doit annuler la colocation.']);
        }

        $memberToRemove = $colocation->users()->where('user_id', $member->id)->first();
        if (!$memberToRemove) {
            return redirect()->back()->withErrors(['error' => 'Le membre n\'est pas dans cette colocation.']);
        }

        DB::beginTransaction();
        try {
            $colocation->users()->updateExistingPivot($member->id, ['left_at' => now()]);

            $balances = $colocation->calculateBalances();
            $userBalance = $balances[$member->id] ?? 0;

            if ($userBalance < 0) {
                $member->decrement('reputation', 1);
            } else {
                $member->increment('reputation', 1);
            }

            if ($isOwner && !$isSelf) {
                $user->decrement('reputation', 1);
            }

            DB::commit();

            if ($isSelf) {
                return redirect()->route('colocations.index')->with('success', 'Vous avez quitté la colocation avec succès.');
            }
            return redirect()->back()->with('success', 'Le membre a été retiré avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Échec du processus de retrait du membre.']);
        }
    }
}
