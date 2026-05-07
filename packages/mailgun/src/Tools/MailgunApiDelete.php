<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Call any Mailgun API DELETE endpoint path.
 */
class MailgunApiDelete extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_api_delete';

    protected string $toolDescription = 'Call any Mailgun API DELETE endpoint path.';

    protected string $method = 'DELETE';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
