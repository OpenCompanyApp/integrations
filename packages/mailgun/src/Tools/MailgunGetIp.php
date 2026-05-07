<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one IP.
 */
class MailgunGetIp extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_ip';

    protected string $toolDescription = 'Get one IP.';

    protected string $method = 'GET';

    protected string $path = '/ips/{ip}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'ip' => [
        'type' => 'string',
        'required' => true,
        'description' => 'IP address.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'ip',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
