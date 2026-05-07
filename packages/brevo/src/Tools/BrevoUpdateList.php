<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a contact list.
 */
class BrevoUpdateList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_list';

    protected string $toolDescription = 'Update a contact list.';

    protected string $method = 'PUT';

    protected string $path = '/contacts/lists/{list_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'List ID.',
    ],
    'name' => [
        'type' => 'string',
        'required' => false,
        'description' => 'List name.',
    ],
    'folder_id' => [
        'type' => 'integer',
        'required' => false,
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
    'list_id',
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
