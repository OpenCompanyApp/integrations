<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a contact folder.
 */
class BrevoUpdateFolder extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_folder';

    protected string $toolDescription = 'Update a contact folder.';

    protected string $method = 'PUT';

    protected string $path = '/contacts/folders/{folder_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'folder_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Folder ID.',
    ],
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
    'folder_id',
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
