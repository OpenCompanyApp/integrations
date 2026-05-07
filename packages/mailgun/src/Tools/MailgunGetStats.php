<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get total stats for a domain.
 */
class MailgunGetStats extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_stats';

    protected string $toolDescription = 'Get total stats for a domain.';

    protected string $method = 'GET';

    protected string $path = '/{domain}/stats/total';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'event' => [
        'type' => 'array',
        'required' => false,
        'description' => 'Events to include.',
    ],
    'start' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Start date.',
    ],
    'end' => [
        'type' => 'string',
        'required' => false,
        'description' => 'End date.',
    ],
    'resolution' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Resolution: hour, day, or month.',
    ],
    'duration' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Duration window.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'event',
    'start',
    'end',
    'resolution',
    'duration',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
