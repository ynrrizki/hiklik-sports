<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => $query->whereHas(
                'category',
                fn ($query) => $query->where('slug', $category)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
