<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Load an Elastic Email contact by email.
 */
class ElasticEmailGetContact extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_contact';
    }

    public function description(): string
    {
        return 'Load a single Elastic Email contact by email address.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getContact($this->stringArg($args, 'email'));
    }
}
