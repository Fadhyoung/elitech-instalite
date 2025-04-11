<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feed extends Model
{

    protected $fillable = [
        'user_id',
        'media_path',
        'media_type',
        'caption',
        'archived',
    ];

    
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
