<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a contact list.
 */
class BrevoCreateList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_list';

    protected string $toolDescription = 'Create a contact list.';

    protected string $method = 'POST';

    protected string $path = '/contacts/lists';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'List name.',
    ],
    'folder_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Folder ID.',
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
    'folder_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'folder_id' => 'folderId',
];
}
