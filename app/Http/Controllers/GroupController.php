<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $group = $this->groupService->createGroup($request->name);

        return response()->json(['id' => $group->id], 200);
    }
}
