<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List external feeds.
 */
class BrevoListExternalFeeds extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_external_feeds';

    protected string $toolDescription = 'List external feeds.';

    protected string $method = 'GET';

    protected string $path = '/feeds';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'search' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Search term.',
    ],
    'start_date' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Start date.',
    ],
    'end_date' => [
        'type' => 'string',
        'required' => false,
        'description' => 'End date.',
    ],
    'auth_type' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Auth type filter.',
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
    'search',
    'start_date' => 'startDate',
    'end_date' => 'endDate',
    'auth_type' => 'authType',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
