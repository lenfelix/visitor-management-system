<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitation extends Model
{
    use HasFactory;

    protected $fillable = ['visitor_id', 'vehicle_plate_no', 'purpose_of_visit', 'checkinout_status'];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

}
