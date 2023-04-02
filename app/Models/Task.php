<?php

namespace App\Models;

use App\Models\Scopes\TaskScope;
use App\Traits\TaskTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, TaskTrait;

    protected $fillable = [
        'title', 'description', 'date', 'start', 'end', 'completed'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    public static function booted()
    {
        static::addGlobalScope(new TaskScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
