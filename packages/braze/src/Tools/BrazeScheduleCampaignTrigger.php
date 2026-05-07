<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Schedule an API-triggered campaign.
 */
class BrazeScheduleCampaignTrigger extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Campaign trigger schedule payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/campaigns/trigger/schedule/create';

    protected string $toolName = 'braze_schedule_campaign_trigger';

    protected string $toolDescription = 'Schedule an API-triggered campaign.';
}