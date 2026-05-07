<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List contact folders.
 */
class BrevoListFolders extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_folders';

    protected string $toolDescription = 'List contact folders.';

    protected string $method = 'GET';

    protected string $path = '/contacts/folders';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
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
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
