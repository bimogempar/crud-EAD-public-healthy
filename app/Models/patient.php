<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function vaccine()
    {
        return $this->belongsTo(vaccine::class);
    }
}
