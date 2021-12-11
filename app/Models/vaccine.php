<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccine extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function patient()
    {
        return $this->hasMany(patient::class);
    }
}
