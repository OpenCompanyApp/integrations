<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Call any Brevo API DELETE endpoint path.
 */
class BrevoApiDelete extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_api_delete';

    protected string $toolDescription = 'Call any Brevo API DELETE endpoint path.';

    protected string $method = 'DELETE';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path to delete.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
