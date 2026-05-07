<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a contact list.
 */
class BrevoDeleteList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_list';

    protected string $toolDescription = 'Delete a contact list.';

    protected string $method = 'DELETE';

    protected string $path = '/contacts/lists/{list_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'List ID.',
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
];
}
