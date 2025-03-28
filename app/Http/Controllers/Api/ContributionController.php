<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Models\Contribution;

class ContributionController extends Controller
{
    public function index()
    {
        return response()->json(Contribution::with('member')->get(), 200);
    }

    public function store(ContributionRequest $request)
    {
        $contribution = Contribution::create($request->validated());
        return response()->json($contribution->load('member'), 201);
    }

    public function show($id)
    {
        $contribution = Contribution::with('member')->findOrFail($id);
        return response()->json($contribution, 200);
    }

    public function update(ContributionRequest $request, $id)
    {
        $contribution = Contribution::findOrFail($id);
        $contribution->update($request->validated());
        return response()->json($contribution->load('member'), 200);
    }

    public function destroy($id)
    {
        $contribution = Contribution::findOrFail($id);
        $contribution->delete();
        return response()->json(null, 204);
    }
}
