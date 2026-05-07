<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Create a blocked SMTP domain.
 */
class BrevoCreateBlockedDomain extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_create_blocked_domain';

    protected string $toolDescription = 'Create a blocked SMTP domain.';

    protected string $method = 'POST';

    protected string $path = '/smtp/blockedDomains';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Domain name.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
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
    'domain',
];
}
