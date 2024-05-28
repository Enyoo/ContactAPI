<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return response()->json(Contact::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'required|string|max:20',
            'cell' => 'sometimes|nullable|string|max:20',
        ]);

        $contact = Contact::create($validatedData);
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json(['message' => 'Contact not found'], 404);
        }
        return response()->json($contact, 200);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:contacts,email,' . $id,
            'phone' => 'sometimes|required|string|max:20',
            'cell' => 'sometimes|nullable|string|max:20',
        ]);

        $contact->update($validatedData);
        return response()->json($contact, 200);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $contact->delete();
        return response()->json(null, 204);
    }
}
