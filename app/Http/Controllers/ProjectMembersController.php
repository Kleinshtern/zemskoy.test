<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignMemberRequest;
use App\Http\Requests\ProjectMembers\UpdateTypeMemberRequest;
use App\Models\ProjectMembers;
use App\Models\Projects;
use Illuminate\Http\JsonResponse;

class ProjectMembersController extends Controller
{
    public function updateTypeMember(UpdateTypeMemberRequest $updateTypeMemberRequest, Projects $project , ProjectMembers $member): JsonResponse
    {
        $validated = $updateTypeMemberRequest->validated();

        $member->update($validated);
        $member->load('user');

        return response()->json([
            'message' => 'Member success updated',
            'member' => $member
        ]);
    }

    public function assignMember(AssignMemberRequest $assignMemberRequest, Projects $project)
    {
        $validated = $assignMemberRequest->validated();

        $member = ProjectMembers::createMember($validated, $project);

        return response()->json([
            'message' => 'Member success assigned',
            'member' => $member
        ]);
    }

    public function excludeMember(Projects $project, ProjectMembers $member): JsonResponse
    {
        $member->delete();

        return response()->json([
            'message' => 'Member successfully excluded'
        ]);
    }
}
