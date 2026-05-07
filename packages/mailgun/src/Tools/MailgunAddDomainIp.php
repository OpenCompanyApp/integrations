<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Assign an IP to a domain.
 */
class MailgunAddDomainIp extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_add_domain_ip';

    protected string $toolDescription = 'Assign an IP to a domain.';

    protected string $method = 'POST';

    protected string $path = '/domains/{domain}/ips';

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
        'description' => 'IP address to assign.',
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
    protected array $bodyParams = [
    'ip',
];
}
