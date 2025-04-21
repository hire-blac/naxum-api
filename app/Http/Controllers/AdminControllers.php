<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminControllers extends Controller
{
  public function index() {
      return view('admin.dashboard');
  }

  public function users() {
      $users = User::all();
      return view('admin.users', compact('users'));
  }

  public function createUser(Request $request) {
      $validated = $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
      ]);

      User::create([
          'name' => $validated['name'],
          'email' => $validated['email'],
          'password' => bcrypt($validated['password']),
      ]);

      return redirect()->back()->with('success', 'User created');
  }
}