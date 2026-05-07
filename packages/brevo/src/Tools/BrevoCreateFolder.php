<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a contact folder.
 */
class BrevoCreateFolder extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_folder';

    protected string $toolDescription = 'Create a contact folder.';

    protected string $method = 'POST';

    protected string $path = '/contacts/folders';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Folder name.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
];
}
