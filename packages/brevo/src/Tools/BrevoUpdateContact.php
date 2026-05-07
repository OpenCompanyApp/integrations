<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a contact.
 */
class BrevoUpdateContact extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_contact';

    protected string $toolDescription = 'Update a contact.';

    protected string $method = 'PUT';

    protected string $path = '/contacts/{identifier}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'identifier' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Contact identifier.',
    ],
    'attributes' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Contact attributes.',
    ],
    'list_ids' => [
        'type' => 'array',
        'required' => false,
        'description' => 'List IDs.',
    ],
    'unlink_list_ids' => [
        'type' => 'array',
        'required' => false,
        'description' => 'List IDs to remove.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'identifier',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'attributes',
    'list_ids' => 'listIds',
    'unlink_list_ids' => 'unlinkListIds',
];
}
