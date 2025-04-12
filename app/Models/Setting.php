<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{

    protected $fillable = [
        'feeds_per_row',
    ];
    
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
