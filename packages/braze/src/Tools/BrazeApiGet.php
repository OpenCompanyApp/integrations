<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Call any Braze REST API GET endpoint with query parameters.
 */
class BrazeApiGet extends AbstractBrazeTool
{
    protected array $parameters = array (
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Endpoint path relative to the Braze REST endpoint.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Additional query parameters.',
  ),
);

    protected array $required = array (
  0 => 'path',
);

    protected array $queryParams = array (
  0 => 'query',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/{path}';

    protected string $toolName = 'braze_api_get';

    protected string $toolDescription = 'Call any Braze REST API GET endpoint with query parameters.';
}