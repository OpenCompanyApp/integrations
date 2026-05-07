<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Add contacts to a contact list.
 */
class BrevoAddContactsToList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_add_contacts_to_list';

    protected string $toolDescription = 'Add contacts to a contact list.';

    protected string $method = 'POST';

    protected string $path = '/contacts/lists/{list_id}/contacts/add';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'List ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
