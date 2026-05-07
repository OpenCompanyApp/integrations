<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a blocked SMTP domain.
 */
class BrevoDeleteBlockedDomain extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_blocked_domain';

    protected string $toolDescription = 'Delete a blocked SMTP domain.';

    protected string $method = 'DELETE';

    protected string $path = '/smtp/blockedDomains/{domain}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Domain name.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
