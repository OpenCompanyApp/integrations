<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Call any Braze REST API PATCH endpoint with a JSON payload.
 */
class BrazeApiPatch extends AbstractBrazeTool
{
    protected array $parameters = array (
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Endpoint path relative to the Braze REST endpoint.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body.',
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
  0 => 'payload',
);

    protected string $method = 'PATCH';

    protected string $path = '/{path}';

    protected string $toolName = 'braze_api_patch';

    protected string $toolDescription = 'Call any Braze REST API PATCH endpoint with a JSON payload.';
}