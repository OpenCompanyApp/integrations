<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List blocked SMTP contacts.
 */
class BrevoListBlockedContacts extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_blocked_contacts';

    protected string $toolDescription = 'List blocked SMTP contacts.';

    protected string $method = 'GET';

    protected string $path = '/smtp/blockedContacts';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'email' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Email filter.',
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
    'email',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
