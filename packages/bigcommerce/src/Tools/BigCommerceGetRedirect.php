<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Get one BigCommerce Redirect.
 */
class BigCommerceGetRedirect extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_get_redirect';

    protected string $toolDescription = 'Get one BigCommerce Redirect.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/redirects/{redirect_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Redirect ID.',
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
  0 => 'redirect_id',
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}