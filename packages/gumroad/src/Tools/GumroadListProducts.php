<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List all Gumroad products for the authenticated account.
 */
class GumroadListProducts extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_products';

    protected string $toolDescription = 'List all Gumroad products for the authenticated account.';

    protected string $method = 'GET';

    protected string $path = '/products';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
