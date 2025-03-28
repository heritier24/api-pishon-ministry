<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return response()->json(Donation::all(), 200);
    }

    public function store(DonationRequest $request)
    {
        $donation = Donation::create($request->validated());
        return response()->json($donation, 201);
    }

    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return response()->json($donation, 200);
    }

    public function update(DonationRequest $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update($request->validated());
        return response()->json($donation, 200);
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();
        return response()->json(null, 204);
    }
}
