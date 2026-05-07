<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List account IPs.
 */
class MailgunListIps extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_ips';

    protected string $toolDescription = 'List account IPs.';

    protected string $method = 'GET';

    protected string $path = '/ips';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
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
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'skip',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
