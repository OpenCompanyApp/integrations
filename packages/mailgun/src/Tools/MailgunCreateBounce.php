<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a Mailgun Bounce record.
 */
class MailgunCreateBounce extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_bounce';

    protected string $toolDescription = 'Create a Mailgun Bounce record.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/bounces';

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
    'code' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'SMTP bounce status code, such as 550.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional suppression fields.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
protected array $bodyParams = [
    'address',
    'code',
];
}
