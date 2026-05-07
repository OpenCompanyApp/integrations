<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List eCommerce categories.
 */
class BrevoListCategories extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_categories';

    protected string $toolDescription = 'List eCommerce categories.';

    protected string $method = 'GET';

    protected string $path = '/categories';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'ids' => [
        'type' => 'array',
        'required' => false,
        'description' => 'Category IDs filter.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return.',
    ],
    'offset' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'sort' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sort order when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'ids',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
