<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Update an Elastic Email contact.
 */
class ElasticEmailUpdateContact extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_update_contact';
    }

    public function description(): string
    {
        return 'Update an Elastic Email contact by email address.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Contact payload fields to update.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->updateContact($this->stringArg($args, 'email'), $this->params($args, 'payload'));
    }
}
