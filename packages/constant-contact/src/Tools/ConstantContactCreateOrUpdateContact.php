<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Create or update a Constant Contact contact from a sign-up form payload.
 */
class ConstantContactCreateOrUpdateContact extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_create_or_update_contact';
    }

    public function description(): string
    {
        return 'Create or update a contact using Constant Contact sign_up_form semantics.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Constant Contact sign_up_form contact payload.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->createOrUpdateContact($this->params($args, 'payload'));
    }
}
