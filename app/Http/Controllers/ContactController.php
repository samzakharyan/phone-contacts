<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest; // import the correct request class
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $contacts = Contact::paginate(10);

        return ContactResource::collection($contacts);
    }

    public function store(StoreContactRequest $request): ContactResource
    {
        $contact = Contact::create($request->validated());

        return new ContactResource($contact);
    }
    
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    public function update(
        UpdateContactRequest $request,
        Contact $contact
    ): ContactResource
    {
        $contact->update($request->validated());

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();

        return response()->json(null, 204);
    }
}
