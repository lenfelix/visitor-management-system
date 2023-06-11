<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use App\Models\Visitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CheckController extends Controller
{
    public function checkIn(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'identity' => 'required',
            'phone' => 'required',
            'purpose' => 'required',
            'remarks' => 'nullable|string|max:100',
        ]);

        $visitor = Visitor::create([
            'full_name' => $data['name'],
            'identity' => $data['identity'],
            'phone' => $data['phone'],
        ]);

        $visitations = Visitation::create([
            'visitor_id' => $visitor->id,
            'vehicle_plate_no' => $data['vehicleno'] ?? null,
            'purpose_of_visit' => $data['purpose'],
            'checkinout_status' => "1",
        ]);

        $visitor->save();
        $visitations->save();



        return response()->json(['message' => 'Check-in successful']);
    }

    public function checkOut(Request $request)
    {
        if ($request->params['visitation_id']) {
            $visitation = Visitation::find($request->params['visitation_id']);
            if ($visitation) {
                $visitation->checkinout_status = '0';
                $visitation->save();
            }
        }
        return;
    }


}
