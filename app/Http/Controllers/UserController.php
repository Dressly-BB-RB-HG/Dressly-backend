<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $record = $this->show($id);
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return "Felhasználó törölve!";
    }


    public function updatePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'password' => 'required|string|min:8|max:50|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()->all()], 400);
    }

    $user = Auth::user();

    if (!$user || !$user instanceof \App\Models\User) {
        return response()->json(['message' => 'Nem bejelentkezett felhasználó!'], 401);
    }

    // Jelszó frissítése
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json(['message' => 'Jelszó sikeresen frissítve!']);
}

    


    public function updateName(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'string|min:4|max:30'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }
        $user = User::where("id", $id)->update([
            "name" => $request->name,
        ]);
        return response()->json(["user" => $user]);
    }

}
