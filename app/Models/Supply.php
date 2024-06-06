<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Models\SupplyIssue;

class Supply extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        "name",
        "description",
        "price",
        "amont"
    ];

    public function issues()
    {
        return $this->hasMany(SupplyIssue::class);
    }
}
