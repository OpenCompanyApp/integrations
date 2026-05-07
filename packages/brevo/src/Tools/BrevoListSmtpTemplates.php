<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List SMTP templates.
 */
class BrevoListSmtpTemplates extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_smtp_templates';

    protected string $toolDescription = 'List SMTP templates.';

    protected string $method = 'GET';

    protected string $path = '/smtp/templates';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'template_status' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Filter by active status.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return.',
    ],
    'offset' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'sort' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sort order when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'template_status' => 'templateStatus',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
