<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use App\Models\Visitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VisitationController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('searchQuery');

        $visitations = Visitation::with(['visitor' => function ($query) use ($searchQuery) {
            if (!empty($searchQuery)) {
                $query->where('phone', 'like', '%' . $searchQuery . '%');
            }
        }])
        ->whereHas('visitor', function ($query) use ($searchQuery) {
            if (!empty($searchQuery)) {
                $query->where('phone', 'like', '%' . $searchQuery . '%');
            }
        })
        ->orWhereDoesntHave('visitor')
        ->get()
        ->map(function ($visitation) {
            return [
                'visitor' => $visitation->visitor,
                'id' => $visitation->id,
                'vehicle_plate_no' => $visitation->vehicle_plate_no,
                'purpose_of_visit' => $visitation->purpose_of_visit,
                'checkinout_status' => $visitation->checkinout_status,
                'remarks' => $visitation->remarks,
                'formatted_updated_at' => $visitation->updated_at->format('Y-m-d H:i:s'),
            ];
        });
        
        $today = Carbon::today();
        $todayC1 = Visitation::where('checkinout_status', '1')
            ->whereDate('created_at', $today)
            ->count();

        $todayC0 = Visitation::where('checkinout_status', '0')
            ->whereDate('created_at', $today)
            ->count();

        return response()->json(['visitation' => $visitations, 'todayC1' => $todayC1, 'todayC0' => $todayC0]);
    }

}
