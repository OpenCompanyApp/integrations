<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get URL details for a campaign message variation.
 */
class BrazeGetCampaignUrlInfo extends AbstractBrazeTool
{
    protected array $parameters = array (
  'campaign_id' =>
  array (
    'type' => 'string',
    'description' => 'Campaign ID.',
    'required' => true,
  ),
  'message_variation_id' =>
  array (
    'type' => 'string',
    'description' => 'Message variation ID.',
  ),
);

    protected array $required = array (
  0 => 'campaign_id',
);

    protected array $queryParams = array (
  0 => 'campaign_id',
  1 => 'message_variation_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/campaigns/url_info/details';

    protected string $toolName = 'braze_get_campaign_url_info';

    protected string $toolDescription = 'Get URL details for a campaign message variation.';
}