<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a scheduled API-triggered campaign.
 */
class BrazeUpdateCampaignTriggerSchedule extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Campaign trigger schedule update payload.',
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

    protected string $path = '/campaigns/trigger/schedule/update';

    protected string $toolName = 'braze_update_campaign_trigger_schedule';

    protected string $toolDescription = 'Update a scheduled API-triggered campaign.';
}