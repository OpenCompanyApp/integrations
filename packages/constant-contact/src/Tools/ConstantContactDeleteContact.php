<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Delete a Constant Contact contact by ID.
 */
class ConstantContactDeleteContact extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_delete_contact';
    }

    public function description(): string
    {
        return 'Delete a Constant Contact contact by contact ID.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->deleteContact($this->stringArg($args, 'contact_id'));
    }
}
