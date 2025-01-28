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


    public function updateProfile(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(), 
        'old_password' => 'required_with:new_password',
        'new_password' => 'nullable|min:8|confirmed', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Hibás adatokat küldtél.',
            'errors' => $validator->errors()
        ], 422);
    }

    $user = Auth::user();

    if ($request->has('old_password') && !Hash::check($request->old_password, $user->password)) {
        return response()->json([
            'message' => 'A régi jelszó nem megfelelő.',
            'errors' => ['old_password' => ['A régi jelszó nem megfelelő.']]
        ], 422);
    }


    if ($request->has('name')) {
        $user->name = $request->name;
    }
    if ($request->has('email')) {
        $user->email = $request->email;
    }
    if ($request->has('new_password')) {
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return response()->json([
        'message' => 'A profil sikeresen frissítve!',
    ]);
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

    public function updateRole(Request $request, $id)
{
    // Validáljuk az új szerepet
    $validator = Validator::make($request->all(), [
        'role' => 'required|integer|in:1,2,3', // Csak az érvényes szerepek: 1 (Admin), 2 (Raktáros), 3 (Felhasználó)
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Hibás szerep!'], 400);
    }

    // Felhasználó keresése
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'Felhasználó nem található!'], 404);
    }

    // Szerep módosítása
    $user->role = $request->role;
    $user->save();

    return response()->json(['message' => 'Szerep sikeresen módosítva!'], 200);
}

}
