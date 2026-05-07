<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Site.
 */
class BigCommerceDeleteSite extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_site';

    protected string $toolDescription = 'Delete a BigCommerce Site.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/sites/{site_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'site_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Site ID.',
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