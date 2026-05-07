<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Load an Elastic Email contact list by name.
 */
class ElasticEmailGetList extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_list';
    }

    public function description(): string
    {
        return 'Load an Elastic Email contact list by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'List name.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getList($this->stringArg($args, 'name'));
    }
}
