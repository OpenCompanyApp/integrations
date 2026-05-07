<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Remove contacts from a contact list.
 */
class BrevoRemoveContactsFromList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_remove_contacts_from_list';

    protected string $toolDescription = 'Remove contacts from a contact list.';

    protected string $method = 'POST';

    protected string $path = '/contacts/lists/{list_id}/contacts/remove';

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
