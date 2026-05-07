<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create an inbound route.
 */
class MailgunCreateRoute extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_route';

    protected string $toolDescription = 'Create an inbound route.';

    protected string $method = 'POST';

    protected string $path = '/routes';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Route body including priority, description, expression, and action.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
