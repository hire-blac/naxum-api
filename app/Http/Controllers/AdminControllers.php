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

  public function createUserForm()
  {
      return view('admin.create_user');
  }
  
  public function storeUser(Request $request)
  {
      $data = $request->validate([
          'name' => 'required|string',
          'email' => 'required|email|unique:users',
          'password' => 'required|string|min:6',
      ]);
  
      User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
      ]);
  
      return redirect()->route('admin.users')->with('success', 'User created successfully.');
  }

  public function editUserForm(User $user)
  {
      return view('admin.edit_user', compact('user'));
  }

  public function updateUser(Request $request, User $user)
  {
      $data = $request->validate([
          'name' => 'required|string',
          'email' => 'required|email|unique:users,email,' . $user->id,
          'password' => 'nullable|min:6',
      ]);

      $user->name = $data['name'];
      $user->email = $data['email'];
      if (!empty($data['password'])) {
          $user->password = bcrypt($data['password']);
      }
      $user->save();

      return redirect()->route('admin.users')->with('success', 'User updated successfully.');
  }

  public function deleteUser(User $user)
  {
      $user->delete();
      return redirect()->route('admin.users')->with('success', 'User deleted.');
  }
}