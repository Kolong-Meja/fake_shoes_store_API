<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::select('*')->get();
            $response = [
                'success' => true,
                'message' => 'Users Data',
                'data' => $users
            ];
            return response()->json($users, HttpFoundationResponse::HTTP_OK);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|max:255|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'mobile' => 'required|numeric|min:13',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $user = User::create($request->all());
            $response = [
                'success' => true,
                'message' => 'User data has been successfully created!',
                'data' => $user
            ];
            return response()->json($user, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('*')->find($id);
        $response = [
            'success' => true,
            'message' => "User {$id} Data",
            'data' => $user
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255', 
            'password' => 'nullable|string|max:255|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'mobile' => 'nullable|numeric|min:13',
            'role' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $update_user = $user->update($request->all());

        if ($update_user) {
            $response = [
                'success' => true,
                'message' => "User {$id} data has been successfully updated",
                'data' => $user
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        }

        else {
            $response = [
                'success' => false,
                'message' => "Failed to update user {$id} data",
                'data' => null
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        $response = [
            'success' => true,
            'message' => "User {$id} Data successfully deleted!",
            'data' => $user
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
