<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectMembers\UpdateTypeMemberRequest;
use App\Models\ProjectMembers;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectMembersController extends Controller
{
    public function updateTypeMember(UpdateTypeMemberRequest $updateTypeMemberRequest, ProjectMembers $member): JsonResponse
    {
        $validated = $updateTypeMemberRequest->validated();

        $member->update($validated);
        $member->load('user');

        return response()->json([
            'message' => 'Member success updated',
            'member' => $member
        ]);
    }

    public function assignMember(User $user)
    {

    }

    public function excludeMember(ProjectMembers $member): JsonResponse
    {
        $member->delete();

        return response()->json([
            'message' => 'Member successfully excluded'
        ]);
    }
}
