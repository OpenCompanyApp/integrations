<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Update a BigCommerce Redirect.
 */
class BigCommerceUpdateRedirect extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_update_redirect';

    protected string $toolDescription = 'Update a BigCommerce Redirect.';

    protected string $method = 'PUT';

    protected string $path = '/v3/content/redirects/{redirect_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Redirect ID.',
  ),
  'payload' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Redirect fields to update.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
  0 => 'redirect_id',
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