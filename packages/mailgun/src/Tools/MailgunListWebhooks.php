<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List webhooks configured for a domain.
 */
class MailgunListWebhooks extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_webhooks';

    protected string $toolDescription = 'List webhooks configured for a domain.';

    protected string $method = 'GET';

    protected string $path = '/domains/{domain}/webhooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
