<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\illustComments;

class illusts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'toDataURL',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function illusts()
    {
        return $this->hasMany(illustComments::class);
    }
}
