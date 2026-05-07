<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List BigCommerce Content Pages.
 */
class BigCommerceListContentPages extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_content_pages';

    protected string $toolDescription = 'List BigCommerce Content Pages.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/pages';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = array (
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of records to return.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Page number for paginated endpoints.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional documented BigCommerce query parameters to pass through.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated related resources to include when supported.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Sort field accepted by the BigCommerce endpoint.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Sort direction accepted by the BigCommerce endpoint.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'include',
  3 => 'sort',
  4 => 'direction',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}