<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a contact.
 */
class BrevoCreateContact extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_contact';

    protected string $toolDescription = 'Create a contact.';

    protected string $method = 'POST';

    protected string $path = '/contacts';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'email' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Contact email.',
    ],
    'attributes' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Contact attributes.',
    ],
    'list_ids' => [
        'type' => 'array',
        'required' => false,
        'description' => 'List IDs to add the contact to.',
    ],
    'update_enabled' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Update existing contact if it exists.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'email',
    'attributes',
    'list_ids' => 'listIds',
    'update_enabled' => 'updateEnabled',
];
}
