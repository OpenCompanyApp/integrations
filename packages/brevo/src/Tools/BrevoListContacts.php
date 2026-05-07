<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List contacts in Brevo.
 */
class BrevoListContacts extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_contacts';

    protected string $toolDescription = 'List contacts in Brevo.';

    protected string $method = 'GET';

    protected string $path = '/contacts';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'email' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by email address.',
    ],
    'modified_since' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by modifiedSince timestamp.',
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
    'modified_since' => 'modifiedSince',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
