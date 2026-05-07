<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a Mailgun Unsubscribe record.
 */
class MailgunCreateUnsubscribe extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_unsubscribe';

    protected string $toolDescription = 'Create a Mailgun Unsubscribe record.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/unsubscribes';

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
];
}
