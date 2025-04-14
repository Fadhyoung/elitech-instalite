<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'feeds_per_row',
        'feed_columns',
        'show_videos',
        'show_photos',
    ];

    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
