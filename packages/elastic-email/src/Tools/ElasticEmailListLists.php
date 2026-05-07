<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List Elastic Email contact lists.
 */
class ElasticEmailListLists extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_lists';
    }

    public function description(): string
    {
        return 'List Elastic Email contact lists.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional limit and offset.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listLists($this->params($args));
    }
}
