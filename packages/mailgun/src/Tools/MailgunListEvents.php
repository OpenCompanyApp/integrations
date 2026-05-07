<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List message events for a domain.
 */
class MailgunListEvents extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_events';

    protected string $toolDescription = 'List message events for a domain.';

    protected string $method = 'GET';

    protected string $path = '/{domain}/events';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'skip' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'page' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination cursor or page URL/token.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Mailgun query parameters to pass through.',
    ],
    'event' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Event type filter.',
    ],
    'begin' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Start time.',
    ],
    'end' => [
        'type' => 'string',
        'required' => false,
        'description' => 'End time.',
    ],
    'ascending' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Sort ascending.',
    ],
    'recipient' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Recipient filter.',
    ],
    'subject' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Subject filter.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page',
    'event',
    'begin',
    'end',
    'ascending',
    'recipient',
    'subject',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
