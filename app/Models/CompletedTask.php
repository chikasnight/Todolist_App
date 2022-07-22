<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
   
    protected $fillable = [
        'user_id',
        'header',
        'task',
    

    ];

    
    public function user(){
        return$this->belongsTo(User::class);
    }
}
