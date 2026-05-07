<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Get statistics for an Elastic Email campaign.
 */
class ElasticEmailGetCampaignStatistics extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_get_campaign_statistics';
    }

    public function description(): string
    {
        return 'Get statistics for an Elastic Email campaign by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Campaign name.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCampaignStatistics($this->stringArg($args, 'name'));
    }
}
