<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    public function store(MemberRequest $request)
{
    try {
        $member = Member::create($request->validated());
        return response()->json($member, 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to create member: ' . $e->getMessage()], 500);
    }
}

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member, 200);
    }

    public function update(MemberRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->update($request->validated());
        return response()->json($member, 200);
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return response()->json(null, 204);
    }
}
