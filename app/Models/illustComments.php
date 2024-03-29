<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\illusts;

class illustComments extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function illusts()
    {
        return $this->belongsTo(illusts::class);
    }
}
