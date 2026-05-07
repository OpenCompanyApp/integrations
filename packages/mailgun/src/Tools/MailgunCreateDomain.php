<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a Mailgun sending domain.
 */
class MailgunCreateDomain extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_domain';

    protected string $toolDescription = 'Create a Mailgun sending domain.';

    protected string $method = 'POST';

    protected string $path = '/v4/domains';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Domain create body, such as name and smtp_password.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
