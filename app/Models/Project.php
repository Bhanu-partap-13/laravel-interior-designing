<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'designer_id',
        'category_id',
        'title',
        'slug',
        'description',
        'before_image',
        'after_image',
        'invoice_proof',
        'gallery',
        'budget_range',
        'duration_days',
        'style_tags',
        'is_published',
        'views_count',
    ];

    protected $casts = [
        'gallery' => 'array',
        'style_tags' => 'array',
        'is_published' => 'boolean',
        'duration_days' => 'integer',
        'views_count' => 'integer',
    ];

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
