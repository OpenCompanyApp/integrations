<?php

namespace OpenCompany\Integrations\Airtable\Tools;

/**
 * Call any Airtable Web API GET endpoint with query parameters.
 */
class AirtableApiGet extends AbstractAirtableTool
{
    protected array $parameters = array (
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Endpoint path relative to the Airtable API base URL.',
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

    protected string $toolName = 'airtable_api_get';

    protected string $toolDescription = 'Call any Airtable Web API GET endpoint with query parameters.';
}
