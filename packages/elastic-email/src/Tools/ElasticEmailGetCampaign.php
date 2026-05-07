<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Get an Elastic Email campaign by name.
 */
class ElasticEmailGetCampaign extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_campaign';
    }

    public function description(): string
    {
        return 'Get an Elastic Email campaign by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Campaign name.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCampaign($this->stringArg($args, 'name'));
    }
}
