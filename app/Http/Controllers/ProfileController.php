<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'license_number' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/doctors/' . $user->photo);
            }
            $filename = time() . '.' . $request->photo->extension();
            // $request->photo->storeAs('public/doctors', $filename);
            $request->photo->storeAs('doctors', $filename, 'public');

            $user->photo = $filename;
        }

        $user->fill($request->only([
            'name',
            'phone',
            'specialization',
            'bio',
            'license_number',
            'gender',
            'date_of_birth'
        ]));

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function show($id = null)
    {
        $user = $id ? User::findOrFail($id) : auth()->user();
        return view('profile.show', compact('user'));
    }
}
