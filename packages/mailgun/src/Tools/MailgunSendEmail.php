<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Send an email with Mailgun messages API.
 */
class MailgunSendEmail extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_send_email';

    protected string $toolDescription = 'Send an email with Mailgun messages API.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/messages';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'from' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Sender address.',
    ],
    'to' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Recipient addresses.',
    ],
    'subject' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email subject.',
    ],
    'text' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Plain text body.',
    ],
    'html' => [
        'type' => 'string',
        'required' => false,
        'description' => 'HTML body.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional Mailgun message parameters, such as cc, bcc, h:Reply-To, o:tag, or attachments.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'from',
    'to',
    'subject',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'from',
    'to',
    'subject',
    'text',
    'html',
];
}
