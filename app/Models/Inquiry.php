<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'visitor_name',
        'visitor_email',
        'message',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
