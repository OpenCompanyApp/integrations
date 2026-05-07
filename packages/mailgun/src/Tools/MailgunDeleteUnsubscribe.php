<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a Mailgun Unsubscribe record.
 */
class MailgunDeleteUnsubscribe extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_unsubscribe';

    protected string $toolDescription = 'Delete a Mailgun Unsubscribe record.';

    protected string $method = 'DELETE';

    protected string $path = '/{domain}/unsubscribes/{address}';

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
