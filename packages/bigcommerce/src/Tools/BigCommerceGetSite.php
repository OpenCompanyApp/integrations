<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Site.
 */
class BigCommerceGetSite extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_site';

    protected string $toolDescription = 'Get one BigCommerce Site.';

    protected string $method = 'GET';

    protected string $path = '/v3/sites/{site_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'site_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Site ID.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented query parameters.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'site_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}