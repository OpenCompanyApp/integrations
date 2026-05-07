<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List Mailgun Complaints for a domain.
 */
class MailgunListComplaints extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_complaints';

    protected string $toolDescription = 'List Mailgun Complaints for a domain.';

    protected string $method = 'GET';

    protected string $path = '/{domain}/complaints';

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
    'address' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Email address filter.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page',
    'address',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
