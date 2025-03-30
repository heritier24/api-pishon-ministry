<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $memberId = $request->query('member_id');

        if (!$type || !$startDate || !$endDate) {
            return response()->json(['message' => 'Missing required parameters'], 400);
        }

        switch ($type) {
            case 'members':
                $data = Member::whereBetween('created_at', [$startDate, $endDate])->get();
                break;
            case 'contributions':
                $query = Contribution::with('member')->whereBetween('created_at', [$startDate, $endDate]);
                if ($memberId) {
                    $query->where('member_id', $memberId);
                }
                $data = $query->get();
                break;
            case 'events':
                $data = Event::whereBetween('date', [$startDate, $endDate])->get();
                break;
            case 'donations':
                $data = Donation::whereBetween('created_at', [$startDate, $endDate])->get();
                break;
            default:
                return response()->json(['message' => 'Invalid report type'], 400);
        }

        return response()->json($data, 200);
    }
}
