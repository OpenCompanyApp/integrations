<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get a contact list.
 */
class BrevoGetList extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_list';

    protected string $toolDescription = 'Get a contact list.';

    protected string $method = 'GET';

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
