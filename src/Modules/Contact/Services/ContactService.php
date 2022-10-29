<?php

namespace Modules\Contact\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Contact\Dto\CreateContactDto;
use Modules\Contact\Dto\UpdateContactDto;
use Modules\Contact\Factories\ContactFactory;
use Modules\Contact\Models\Contact;
use Modules\Contact\Repositories\ContactRepository;
use Modules\User\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContactService
{
    public function __construct(
        private ContactRepository $repository,
        private ContactFactory $factory
    ) {
    }

    public function create(User $user, CreateContactDto $dto): Contact
    {
        $contact = $this->factory->create();
        $contact->fill($dto->toArray());
        $contact->user_id = $user->id;
        $this->repository->save($contact);

        return $contact;
    }

    public function tryGetByUserAndId(int $userId, int $contactId): Contact
    {
        $contact = $this->repository->getByUserAndId($userId, $contactId);
        if (!$contact) {
            throw new NotFoundHttpException(__('Not found'));
        }

        return $contact;
    }

    public function getUserList(int $userId): Collection
    {
        return $this->repository->getUserList($userId);
    }

    public function update(Contact $contact, UpdateContactDto $dto): Contact
    {
        $contact->fill(array_diff($dto->toArray(), ['', null, false]));
        $this->repository->save($contact);

        return $contact;
    }

    public function delete(Contact $contact): void
    {
        $this->repository->delete($contact);
    }
}
