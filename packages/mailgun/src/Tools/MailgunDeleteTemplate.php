<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a template.
 */
class MailgunDeleteTemplate extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_template';

    protected string $toolDescription = 'Delete a template.';

    protected string $method = 'DELETE';

    protected string $path = '/{domain}/templates/{template_name}';

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
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
