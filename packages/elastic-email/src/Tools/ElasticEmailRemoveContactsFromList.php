<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Remove contacts from an Elastic Email list.
 */
class ElasticEmailRemoveContactsFromList extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_remove_contacts_from_list';
    }

    public function description(): string
    {
        return 'Remove one or more contacts from an Elastic Email list.';
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
        return $this->service->removeContactsFromList($this->stringArg($args, 'name'), $this->emailListArg($args, 'emails'));
    }
}
