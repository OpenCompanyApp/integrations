<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List contact lists in a folder.
 */
class BrevoListFolderLists extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_folder_lists';

    protected string $toolDescription = 'List contact lists in a folder.';

    protected string $method = 'GET';

    protected string $path = '/contacts/folders/{folder_id}/lists';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'folder_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Folder ID.',
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
    'folder_id',
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
