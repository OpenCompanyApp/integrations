<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List WhatsApp transactional events.
 */
class BrevoListWhatsAppEvents extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_whatsapp_events';

    protected string $toolDescription = 'List WhatsApp transactional events.';

    protected string $method = 'GET';

    protected string $path = '/whatsapp/statistics/events';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
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
