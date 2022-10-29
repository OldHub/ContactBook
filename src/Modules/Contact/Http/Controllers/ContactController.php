<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Contact\Dto\CreateContactDto;
use Modules\Contact\Dto\UpdateContactDto;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;
use Modules\Contact\Resources\ContactResource;
use Modules\Contact\Services\ContactService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService
    ) {
    }

    /**
     * @throws UnknownProperties
     */
    public function create(CreateContactRequest $request): ContactResource
    {
        $dto = new CreateContactDto($request->all());

        return ContactResource::make($this->contactService->create($request->user(), $dto));
    }

    public function read(Request $request, int $id): ContactResource
    {
        return ContactResource::make($this->contactService->tryGetByUserAndId($request->user()->id, $id));
    }

    public function list(Request $request): AnonymousResourceCollection
    {
        return ContactResource::collection($this->contactService->getUserList($request->user()->id));
    }

    /**
     * @throws UnknownProperties
     */
    public function update(UpdateContactRequest $request, int $id): ContactResource
    {
        $dto     = new UpdateContactDto($request->all());
        $contact = $this->contactService->tryGetByUserAndId($request->user()->id, $id);
        $this->contactService->update($contact, $dto);

        return ContactResource::make($contact);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $contact = $this->contactService->tryGetByUserAndId($request->user()->id, $id);
        $this->contactService->delete($contact);

        return response()->json(['message' => __('Successful')]);
    }
}
