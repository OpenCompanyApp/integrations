<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Delete an Elastic Email contact.
 */
class ElasticEmailDeleteContact extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_delete_contact';
    }

    public function description(): string
    {
        return 'Delete an Elastic Email contact by email address.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->deleteContact($this->stringArg($args, 'email'));
    }
}
