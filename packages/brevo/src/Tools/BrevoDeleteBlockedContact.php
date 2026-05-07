<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Unblock an SMTP contact.
 */
class BrevoDeleteBlockedContact extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_blocked_contact';

    protected string $toolDescription = 'Unblock an SMTP contact.';

    protected string $method = 'DELETE';

    protected string $path = '/smtp/blockedContacts/{email}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'email' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email address.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'email',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
