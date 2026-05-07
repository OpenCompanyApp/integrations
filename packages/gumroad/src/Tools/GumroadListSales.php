<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List successful sales with optional filters.
 */
class GumroadListSales extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_sales';

    protected string $toolDescription = 'List successful sales with optional filters.';

    protected string $method = 'GET';

    protected string $path = '/sales';

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
    'email' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by buyer email when supported.',
    ],
    'before' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Only return sales before this timestamp.',
    ],
    'after' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Only return sales after this timestamp.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page',
    'product_id',
    'email',
    'before',
    'after',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
