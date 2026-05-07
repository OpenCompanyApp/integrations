<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one template.
 */
class MailgunGetTemplate extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_template';

    protected string $toolDescription = 'Get one template.';

    protected string $method = 'GET';

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
