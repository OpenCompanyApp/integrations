<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Update a Constant Contact contact by ID.
 */
class ConstantContactUpdateContact extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_update_contact';
    }

    public function description(): string
    {
        return 'Update a Constant Contact contact by contact ID.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Contact payload fields.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->updateContact($this->stringArg($args, 'contact_id'), $this->params($args, 'payload'));
    }
}
