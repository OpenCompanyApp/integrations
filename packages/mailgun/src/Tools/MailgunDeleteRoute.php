<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete an inbound route.
 */
class MailgunDeleteRoute extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_route';

    protected string $toolDescription = 'Delete an inbound route.';

    protected string $method = 'DELETE';

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
