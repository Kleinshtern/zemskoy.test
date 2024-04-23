<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserSearch extends Controller
{
    public function findBySearchString()
    {
        $users = DB::table("users")
            ->select([
                'id', 'name', 'email'
            ])
            ->whereAny([
                'name',
                'email'
            ], 'LIKE', '%' . request('query') . '%')
            ->get();

        return response()->json([
            'message' => 'Search users final',
            'users' => $users
        ]);
    }
}
