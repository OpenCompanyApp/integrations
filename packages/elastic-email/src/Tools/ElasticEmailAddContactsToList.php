<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Add contacts to an Elastic Email list.
 */
class ElasticEmailAddContactsToList extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_add_contacts_to_list';
    }

    public function description(): string
    {
        return 'Add one or more contacts to an Elastic Email list.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
            'emails' => ['type' => 'string', 'required' => true, 'description' => 'Comma- or semicolon-separated email addresses.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->addContactsToList($this->stringArg($args, 'name'), $this->emailListArg($args, 'emails'));
    }
}
