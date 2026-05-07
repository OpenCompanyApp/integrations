<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one Mailgun Allowlist record.
 */
class MailgunGetAllowlist extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_allowlist';

    protected string $toolDescription = 'Get one Mailgun Allowlist record.';

    protected string $method = 'GET';

    protected string $path = '/{domain}/whitelists/{address}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email address.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
