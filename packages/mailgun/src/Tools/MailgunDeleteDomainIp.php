<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Remove an IP from a domain.
 */
class MailgunDeleteDomainIp extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_domain_ip';

    protected string $toolDescription = 'Remove an IP from a domain.';

    protected string $method = 'DELETE';

    protected string $path = '/domains/{domain}/ips/{ip}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailgun domain.',
    ],
    'ip' => [
        'type' => 'string',
        'required' => true,
        'description' => 'IP address to remove.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain',
    'ip',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
