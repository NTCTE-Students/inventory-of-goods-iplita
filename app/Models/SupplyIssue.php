<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_id',
        'quantity',
    ];

    public function issues(int $quantity)
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity;
            $this->save();

            SupplyIssue::create([
                'supply_id' => $this->id,
                'quantity' => $quantity,
            ]);

            return true;
        }

        return false;
    }
}
