<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get a Mailgun domain and DNS records.
 */
class MailgunGetDomain extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_domain';

    protected string $toolDescription = 'Get a Mailgun domain and DNS records.';

    protected string $method = 'GET';

    protected string $path = '/v4/domains/{domain}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailgun domain.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
