<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Get one subscriber by ID.
 */
class GumroadGetSubscriber extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_get_subscriber';

    protected string $toolDescription = 'Get one subscriber by ID.';

    protected string $method = 'GET';

    protected string $path = '/subscribers/{subscriber_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'subscriber_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad subscriber ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'subscriber_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
