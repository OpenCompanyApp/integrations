<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Call any Mailgun API POST endpoint path.
 */
class MailgunApiPost extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_api_post';

    protected string $toolDescription = 'Call any Mailgun API POST endpoint path.';

    protected string $method = 'POST';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path, such as /routes.',
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
