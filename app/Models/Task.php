<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['task_address' , 'start_time' , 'task_phone' , 'works' , 'start' , 'end' , 'cancele' , 'status' , 'user_id' , 'group' , 'price'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            $task->uuid = (string) Str::uuid();
        });
    }
}
