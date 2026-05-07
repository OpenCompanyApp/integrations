<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Call any Gumroad API v2 GET endpoint path.
 */
class GumroadApiGet extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_api_get';

    protected string $toolDescription = 'Call any Gumroad API v2 GET endpoint path.';

    protected string $method = 'GET';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'API path such as /products.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
