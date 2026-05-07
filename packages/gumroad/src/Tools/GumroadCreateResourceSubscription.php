<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Subscribe a URL to Gumroad resource notifications.
 */
class GumroadCreateResourceSubscription extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_create_resource_subscription';

    protected string $toolDescription = 'Subscribe a URL to Gumroad resource notifications.';

    protected string $method = 'PUT';

    protected string $path = '/resource_subscriptions';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'resource_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Resource name such as sale or refund.',
    ],
    'post_url' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook receiver URL.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented subscription fields.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'resource_name',
    'post_url',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'resource_name',
    'post_url',
];
}
