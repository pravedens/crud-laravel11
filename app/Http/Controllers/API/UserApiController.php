<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json(['status' => true, 'data' => UserResource::collection($users), 'message' => 'Get Data Success']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $imageName = null;

        if($request->photo){
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->photo->storeAs('public/images', $imageName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'photo_profile' => $imageName
        ]);

        return response()->json(['status' => true, 'data' => new UserResource($user), 'message' => 'Save Data Success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['status' => true, 'data' => new UserResource($user), 'message' => 'Show User Success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $request->validated();

        if($request->photo){
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->photo->storeAs('public/images', $imageName);

            //delete old photo
            $path = storage_path('app/public/images/'.$user->photo_profile);
            if(File::exists($path)) {
                File::delete($path);
            }
            $user->photo_profile = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->address = $request->address;

        $user->update();

        return response()->json(['status' => true, 'data' => new UserResource($user), 'message' => 'Update Data Success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $path = storage_path('app/public/images/'.$user->photo_profile);
            if(File::exists($path)) {
                File::delete($path);
            }

            $user->deleteOrFail();

            return response()->noContent();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}