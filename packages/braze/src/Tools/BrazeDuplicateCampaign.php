<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Duplicate a Braze campaign.
 */
class BrazeDuplicateCampaign extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Campaign duplicate payload.',
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

    protected string $path = '/campaigns/duplicate';

    protected string $toolName = 'braze_duplicate_campaign';

    protected string $toolDescription = 'Duplicate a Braze campaign.';
}