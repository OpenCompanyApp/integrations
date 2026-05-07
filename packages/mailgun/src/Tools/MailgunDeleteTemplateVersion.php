<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a template version.
 */
class MailgunDeleteTemplateVersion extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_template_version';

    protected string $toolDescription = 'Delete a template version.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
    'tag',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
