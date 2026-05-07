<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a contact.
 */
class BrevoDeleteContact extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_contact';

    protected string $toolDescription = 'Delete a contact.';

    protected string $method = 'DELETE';

    protected string $path = '/contacts/{identifier}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'identifier' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Contact identifier.',
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
];
}
