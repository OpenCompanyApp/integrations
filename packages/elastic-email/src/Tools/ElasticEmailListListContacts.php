<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List contacts in an Elastic Email list.
 */
class ElasticEmailListListContacts extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in an Elastic Email contact list.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
            'params' => ['type' => 'object', 'description' => 'Optional limit and offset.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listListContacts($this->stringArg($args, 'name'), $this->params($args));
    }
}
