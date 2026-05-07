<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Send a transactional email.
 */
class BrevoSendEmail extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_send_email';

    protected string $toolDescription = 'Send a transactional email.';

    protected string $method = 'POST';

    protected string $path = '/smtp/email';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
