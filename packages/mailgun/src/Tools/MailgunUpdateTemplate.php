<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update template metadata.
 */
class MailgunUpdateTemplate extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_template';

    protected string $toolDescription = 'Update template metadata.';

    protected string $method = 'PUT';

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
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Template update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
