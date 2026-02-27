<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse([
            'data' => []
        ]);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     *
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
