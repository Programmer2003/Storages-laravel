<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function lastCategories()
    {
        $arr = Closure::get()->unique('ancestor')->pluck('ancestor')->toArray();
        return $this->hasMany(Category::class)->whereNotIn('id', $arr);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }
}
