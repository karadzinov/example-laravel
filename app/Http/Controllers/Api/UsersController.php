<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/users",
     *      operationId="getAllUsers",
     *      tags={"Users"},
     *      summary="Get users information",
     *      description="Returns users data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function index()
    {
        $users = User::all();
        $users = UserResource::collection($users);
        $data = ['users' => $users];

        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/users/{id}",
     *      operationId="showUser",
     *      tags={"Users"},
     *      summary="Show User",
     *      description="Returns user's data",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function show(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $user = new UserResource($user);
        $data = ['user' => $user];
        return response()->json($data, 200);
    }


    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="Create User",
     *      tags={"Users"},
     *      summary="Create User",
     *      description="Returns user's data",
     *     @OA\Parameter(
     *          name="name",
     *          description="Create name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Create email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="passwoord",
     *          description="Create password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="role_id",
     *          description="Create Role",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="image",
     *          description="Create image",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */


    public function create(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        $user = User::create($input);
        return response()->json(["success" => "success"], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $input = $request->all();

        if ($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }

        $user->fill($input)->save();
        return response()->json(["success" => "success"], 200);
    }

    /**
     * @OA\Delete (
     *      path="/api/users/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete User",
     *      description="Returns success",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function delete($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        return response()->json([], 200);
    }
}
