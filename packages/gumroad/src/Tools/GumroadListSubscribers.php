<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List subscribers, optionally filtered by product.
 */
class GumroadListSubscribers extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_subscribers';

    protected string $toolDescription = 'List subscribers, optionally filtered by product.';

    protected string $method = 'GET';

    protected string $path = '/subscribers';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'page' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Page number for paginated Gumroad endpoints.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Gumroad query parameters to pass through.',
    ],
    'product_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by product ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page',
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
