<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Call any Mailgun API PUT endpoint path.
 */
class MailgunApiPut extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_api_put';

    protected string $toolDescription = 'Call any Mailgun API PUT endpoint path.';

    protected string $method = 'PUT';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Form request body.',
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
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
