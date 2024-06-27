<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'profile_picture' => 'required|url',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('seller.show', $user->id)->with('success', 'Profile updated successfully.');
    }
}
