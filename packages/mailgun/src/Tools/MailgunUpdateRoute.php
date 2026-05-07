<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update an inbound route.
 */
class MailgunUpdateRoute extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_route';

    protected string $toolDescription = 'Update an inbound route.';

    protected string $method = 'PUT';

    protected string $path = '/routes/{route_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'route_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Route ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Route update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'route_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
