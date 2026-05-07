<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one route by ID.
 */
class MailgunGetRoute extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_route';

    protected string $toolDescription = 'Get one route by ID.';

    protected string $method = 'GET';

    protected string $path = '/routes/{route_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'route_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Route ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'route_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
