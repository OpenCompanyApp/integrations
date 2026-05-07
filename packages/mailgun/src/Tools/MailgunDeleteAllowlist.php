<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a Mailgun Allowlist record.
 */
class MailgunDeleteAllowlist extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_allowlist';

    protected string $toolDescription = 'Delete a Mailgun Allowlist record.';

    protected string $method = 'DELETE';

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
