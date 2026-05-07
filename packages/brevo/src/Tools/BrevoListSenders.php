<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List senders.
 */
class BrevoListSenders extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_senders';

    protected string $toolDescription = 'List senders.';

    protected string $method = 'GET';

    protected string $path = '/senders';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'ip' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sender IP filter.',
    ],
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sender domain filter.',
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
    'ip',
    'domain',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
