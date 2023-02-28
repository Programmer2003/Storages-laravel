<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function mainCategories($storage)
    {
        $arr = DB::table('categories')->leftJoin('closures', 'closures.descendant', '=', 'categories.id')->whereNull('closures.id')->where('categories.storage_id', '=', $storage->id)->pluck('categories.id')->toArray();
        return Category::whereIn('id', $arr)->get();
    }

    public static function lastCategories($storage)
    {
        $arr = DB::table('products')->distinct('category_id')->pluck('category_id')->toArray();
        return Category::whereIn('id', $arr)->where('storage_id', '=', $storage->id)->get();
    }

    public function productsCount()
    {
        return $this->products->count();
    }

    public function descendantsCount()
    {
        return $this->descendants()->count();
    }

    public function descendants()
    {
        $arr = DB::table('categories')->join('closures', 'closures.descendant', '=', 'categories.id')->where('closures.ancestor', '=', $this->id)->pluck('closures.descendant')->toArray();
        return Category::whereIn('id', $arr)->get();
    }
}
