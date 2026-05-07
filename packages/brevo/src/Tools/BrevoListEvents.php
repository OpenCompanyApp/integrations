<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List custom events.
 */
class BrevoListEvents extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_events';

    protected string $toolDescription = 'List custom events.';

    protected string $method = 'GET';

    protected string $path = '/events';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'event_name' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Event name filter.',
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
    'event_name',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
