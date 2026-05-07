<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List Braze campaigns.
 */
class BrazeListCampaigns extends AbstractBrazeTool
{
    protected array $parameters = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'Page number, zero-indexed.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Results per page.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'page',
  1 => 'limit',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/campaigns/list';

    protected string $toolName = 'braze_list_campaigns';

    protected string $toolDescription = 'List Braze campaigns.';
}