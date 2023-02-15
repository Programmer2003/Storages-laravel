<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRetailPrice()
    {
        $category = $this->category;
        $retail = $category->retail;
        if ($category->storage_id == 1) {
            $days = date_diff(now(), $this->created_at)->d;
            $retail += 5 * $days;
        }

        $retail = min($retail, 30);
        return round($this->price * (100 - $retail) / 100, 2);
    }
}
