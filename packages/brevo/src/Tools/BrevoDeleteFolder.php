<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a contact folder.
 */
class BrevoDeleteFolder extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_folder';

    protected string $toolDescription = 'Delete a contact folder.';

    protected string $method = 'DELETE';

    protected string $path = '/contacts/folders/{folder_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'folder_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Folder ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'folder_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
