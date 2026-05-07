<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Pause an Elastic Email campaign.
 */
class ElasticEmailPauseCampaign extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_pause_campaign';
    }

    public function description(): string
    {
        return 'Pause an Elastic Email campaign by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Campaign name.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->pauseCampaign($this->stringArg($args, 'name'));
    }
}
