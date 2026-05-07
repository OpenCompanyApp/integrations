<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Call any Gumroad API v2 DELETE endpoint path.
 */
class GumroadApiDelete extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_api_delete';

    protected string $toolDescription = 'Call any Gumroad API v2 DELETE endpoint path.';

    protected string $method = 'DELETE';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'API path such as /resource_subscriptions/{id}.',
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
