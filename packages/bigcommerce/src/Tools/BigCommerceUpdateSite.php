<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Site.
 */
class BigCommerceUpdateSite extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_site';

    protected string $toolDescription = 'Update a BigCommerce Site.';

    protected string $method = 'PUT';

    protected string $path = '/v3/sites/{site_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'site_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Site ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Site fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'site_id',
  1 => 'payload',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
  0 => 'payload',
);
}