<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List contacts in a contact list.
 */
class BrevoListContactsInList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_contacts_in_list';

    protected string $toolDescription = 'List contacts in a contact list.';

    protected string $method = 'GET';

    protected string $path = '/contacts/lists/{list_id}/contacts';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'List ID.',
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
    'list_id',
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
