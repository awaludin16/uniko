<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order_menus(): HasMany
    {
        return $this->hasMany(OrderMenu::class);
    }
}
