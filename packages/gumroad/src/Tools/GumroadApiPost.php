<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Call any Gumroad API v2 POST endpoint path.
 */
class GumroadApiPost extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_api_post';

    protected string $toolDescription = 'Call any Gumroad API v2 POST endpoint path.';

    protected string $method = 'POST';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'API path such as /licenses/verify.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Request body.',
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
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
