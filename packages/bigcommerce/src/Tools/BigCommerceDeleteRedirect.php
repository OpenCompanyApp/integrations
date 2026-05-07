<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * Delete a BigCommerce Redirect.
 */
class BigCommerceDeleteRedirect extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_delete_redirect';

    protected string $toolDescription = 'Delete a BigCommerce Redirect.';

    protected string $method = 'DELETE';

    protected string $path = '/v3/content/redirects/{redirect_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'BigCommerce Redirect ID.',
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