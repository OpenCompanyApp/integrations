<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * List versions for a template.
 */
class MailgunListTemplateVersions extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_list_template_versions';

    protected string $toolDescription = 'List versions for a template.';

    protected string $method = 'GET';

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
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'skip' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'page' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination cursor or page URL/token.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Mailgun query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'template_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
