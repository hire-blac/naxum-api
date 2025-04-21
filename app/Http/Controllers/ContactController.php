<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @group Contacts
     * 
     * Get all the authenticated user's contacts.
     * 
     * @response 200 [
     *  {
     *    "id": 1,
     *    "name": "John Doe",
     *    "email": "john@example.com",
     *    "phone": "123456789",
     *    "user_id": 1
     *  }
     * ]
     */
    public function index()
    {
      return auth()->user()->contacts()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $data = $request->validate([
          'name' => 'required',
          'email' => 'nullable|email',
          'phone' => 'nullable|string',
      ]);

      $contact = auth()->user()->contacts()->create($data);
      return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
      $this->authorizeAccess($contact);
      return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
      $this->authorizeAccess($contact);

      $data = $request->validate([
          'name' => 'sometimes|required',
          'email' => 'nullable|email',
          'phone' => 'nullable|string',
      ]);

      $contact->update($data);
      return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
      $this->authorizeAccess($contact);
      $contact->delete();
      return response()->json(null, 204);
    }

    protected function authorizeAccess(Contact $contact)
    {
        if ($contact->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}
