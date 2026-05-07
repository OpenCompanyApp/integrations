<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List Elastic Email campaigns.
 */
class ElasticEmailListCampaigns extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_campaigns';
    }

    public function description(): string
    {
        return 'List Elastic Email campaigns.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional limit and offset.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listCampaigns($this->params($args));
    }
}
