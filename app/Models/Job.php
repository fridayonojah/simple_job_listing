<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // protected $fillable  = ['title', 'company', 'location', 
    // 'website', 'email', 'tags', 'description'];

    public function scopeFilter($query, array $filter){
        if($filter['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filter['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->orwhere('tags', 'like', '%' . request('search') . '%');

        }
    }

    // relationship to a user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
