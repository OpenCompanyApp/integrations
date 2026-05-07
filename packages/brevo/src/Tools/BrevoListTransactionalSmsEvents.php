<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List transactional SMS events.
 */
class BrevoListTransactionalSmsEvents extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_transactional_sms_events';

    protected string $toolDescription = 'List transactional SMS events.';

    protected string $method = 'GET';

    protected string $path = '/transactionalSMS/statistics/events';

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
