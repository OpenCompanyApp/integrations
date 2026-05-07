<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get Braze campaign details.
 */
class BrazeGetCampaign extends AbstractBrazeTool
{
    protected array $parameters = array (
  'campaign_id' =>
  array (
    'type' => 'string',
    'description' => 'Campaign ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'campaign_id',
);

    protected array $queryParams = array (
  0 => 'campaign_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/campaigns/details';

    protected string $toolName = 'braze_get_campaign';

    protected string $toolDescription = 'Get Braze campaign details.';
}