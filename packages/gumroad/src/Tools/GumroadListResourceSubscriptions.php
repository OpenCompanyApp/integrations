<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * List webhook resource subscriptions by resource name.
 */
class GumroadListResourceSubscriptions extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_list_resource_subscriptions';

    protected string $toolDescription = 'List webhook resource subscriptions by resource name.';

    protected string $method = 'GET';

    protected string $path = '/resource_subscriptions';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'resource_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Resource name such as sale, refund, cancellation, dispute, subscription_updated, subscription_ended, subscription_restarted, or dispute_won.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'resource_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'resource_name',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
