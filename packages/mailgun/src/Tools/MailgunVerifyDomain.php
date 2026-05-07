<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Trigger Mailgun domain verification.
 */
class MailgunVerifyDomain extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_verify_domain';

    protected string $toolDescription = 'Trigger Mailgun domain verification.';

    protected string $method = 'PUT';

    protected string $path = '/v4/domains/{domain}/verify';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailgun domain.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Optional verification request body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
