<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectMembers\UpdateTypeMemberRequest;
use App\Models\ProjectMembers;
use App\Models\Projects;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    public function loadTypesMember(Projects $project): JsonResponse
    {
        return response()->json([
            'types' => array_map(function($type) {
                return [
                    'value' => $type,
                    'label' => ProjectMembers::TYPES[$type]
                ];
            }, array_keys(ProjectMembers::TYPES))
        ]);
    }
}
