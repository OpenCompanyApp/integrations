<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List members of a mailing list.
 */
class MailgunListMembers extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_members';

    protected string $toolDescription = 'List members of a mailing list.';

    protected string $method = 'GET';

    protected string $path = '/lists/{list_address}/members';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
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
    'subscribed' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Filter subscribed members.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page',
    'subscribed',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
