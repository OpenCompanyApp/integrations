<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Trigger an API-triggered Braze campaign.
 */
class BrazeTriggerCampaignSend extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Campaign trigger payload.',
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

    protected string $path = '/campaigns/trigger/send';

    protected string $toolName = 'braze_trigger_campaign_send';

    protected string $toolDescription = 'Trigger an API-triggered Braze campaign.';
}