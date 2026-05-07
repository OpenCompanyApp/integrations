<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get transactional email status by identifier.
 */
class BrevoGetEmailStatus extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_email_status';

    protected string $toolDescription = 'Get transactional email status by identifier.';

    protected string $method = 'GET';

    protected string $path = '/smtp/emailStatus/{identifier}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'identifier' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email identifier.',
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
    'identifier',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'start_date' => 'startDate',
    'end_date' => 'endDate',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
