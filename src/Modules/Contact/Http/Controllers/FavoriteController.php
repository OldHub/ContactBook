<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contact\Resources\ContactResource;
use Modules\Contact\Services\ContactService;
use Modules\Contact\Services\Favorite\FavoriteService;

class FavoriteController extends Controller
{
    public function __construct(
        private FavoriteService $favoriteService,
        private ContactService $contactService
    ) {
    }

    public function add(Request $request, int $id): ContactResource
    {
        $contact = $this->contactService->tryGetByUserAndId($request->user()->id, $id);
        $this->favoriteService->add($contact);

        return ContactResource::make($contact);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $contact = $this->contactService->tryGetByUserAndId($request->user()->id, $id);
        if ($contact->favorite) {
            $this->favoriteService->delete($contact);
        }

        return response()->json(['message' => __('Successful')]);
    }
}
