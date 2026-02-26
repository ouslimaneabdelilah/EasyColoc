<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Colocation extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'status'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot(['role', 'left_at'])
            ->withTimestamps();
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(Expense::class, Category::class);
    }

    public function calculateBalances()
    {
        $users = $this->users()->get();
        $balances = [];
        foreach ($users as $user) {
            $balances[$user->id] = 0;
        }

        $expenses = $this->expenses;
        $activeUsers = $users->where('pivot.left_at', null);
        $memberCount = $activeUsers->count();

        if ($memberCount > 0) {
            foreach ($expenses as $expense) {
                $share = $expense->amount / $memberCount;

                if (isset($balances[$expense->paid_by])) {
                    $balances[$expense->paid_by] += $expense->amount;
                }

                foreach ($activeUsers as $activeUser) {
                    $balances[$activeUser->id] -= $share;
                }
            }
        }

        $expenseIds = $this->expenses()->pluck('expenses.id');
        $settlements = Settlement::with('expense')->whereIn('expense_id', $expenseIds)->where('status', 'paid')->get();

        foreach ($settlements as $settlement) {
            $payer_id = $settlement->user_id; 
            $payee_id = $settlement->expense->paid_by; 

            if (isset($balances[$payer_id])) {
                $balances[$payer_id] += $settlement->amount;
            }
            if (isset($balances[$payee_id])) {
                $balances[$payee_id] -= $settlement->amount;
            }
        }

        return $balances;
    }
}
