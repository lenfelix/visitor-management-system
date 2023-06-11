<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'identity', 'phone'];

    public function visitations()
    {
        return $this->hasMany(Visitation::class);
    }

}
