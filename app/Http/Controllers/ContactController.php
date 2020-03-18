<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use App\Http\Requests\CreateContactMessageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Apply the contact form then redirect user
     *
     * @param CreateContactMessageRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(CreateContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        if($request->ajax()) {
            return response()->json($message, 201);
        }

        return back();
    }
}
