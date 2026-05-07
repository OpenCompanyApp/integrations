<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get a contact by email, phone, or identifier.
 */
class BrevoGetContact extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_contact';

    protected string $toolDescription = 'Get a contact by email, phone, or identifier.';

    protected string $method = 'GET';

    protected string $path = '/contacts/{identifier}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'identifier' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Contact identifier such as email or external ID.',
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
