<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Send a MIME message with Mailgun.
 */
class MailgunSendMime extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_send_mime';

    protected string $toolDescription = 'Send a MIME message with Mailgun.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/messages.mime';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'to' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Recipient addresses.',
    ],
    'message' => [
        'type' => 'string',
        'required' => true,
        'description' => 'MIME message content or storage reference.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional Mailgun MIME parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'to',
    'message',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'to',
    'message',
];
}
