<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a template version.
 */
class MailgunCreateTemplateVersion extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_template_version';

    protected string $toolDescription = 'Create a template version.';

    protected string $method = 'POST';

    protected string $path = '/{domain}/templates/{template_name}/versions';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'template_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Template name.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Version tag.',
    ],
    'template' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Template content.',
    ],
    'active' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether version is active.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
    'tag',
    'template',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'tag',
    'template',
    'active',
];
}
