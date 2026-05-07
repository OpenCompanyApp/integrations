<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update a template version.
 */
class MailgunUpdateTemplateVersion extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_template_version';

    protected string $toolDescription = 'Update a template version.';

    protected string $method = 'PUT';

    protected string $path = '/{domain}/templates/{template_name}/versions/{tag}';

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
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Version update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
    'tag',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
