<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function show($id)
    {
        $user = User::with('listings.keyword')->findOrFail($id);
        return view('seller.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('seller.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->description = $request->description;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->save();

        return redirect()->route('seller.show', $user->id);
    }
}
