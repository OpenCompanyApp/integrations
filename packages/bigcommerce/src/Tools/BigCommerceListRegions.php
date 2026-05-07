<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

/**
 * List content regions for widget placement.
 */
class BigCommerceListRegions extends AbstractBigCommerceEndpointTool
{
    protected string $toolName = 'bigcommerce_list_regions';

    protected string $toolDescription = 'List content regions for widget placement.';

    protected string $method = 'GET';

    protected string $path = '/v3/content/regions';

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
  'template_file' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Theme template file filter when supported.',
  ),
);

    /** @var list<string> */
    protected array $required = array (
);

    /** @var array<int|string, string> */
    protected array $queryParams = array (
  0 => 'limit',
  1 => 'page',
  2 => 'template_file',
);

    /** @var array<int|string, string> */
    protected array $bodyParams = array (
);
}