<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Call any Mailgun API GET endpoint path.
 */
class MailgunApiGet extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_api_get';

    protected string $toolDescription = 'Call any Mailgun API GET endpoint path.';

    protected string $method = 'GET';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path, such as /domains or /v4/domains.',
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
