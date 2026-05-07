<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create an email template.
 */
class MailgunCreateTemplate extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_template';

    protected string $toolDescription = 'Create an email template.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/templates';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Template name.',
    ],
    'template' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Template content.',
    ],
    'description' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Description.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Version tag.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'name',
    'template',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'template',
    'description',
    'tag',
];
}
