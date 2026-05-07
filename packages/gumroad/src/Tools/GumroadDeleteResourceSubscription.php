<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Delete a Gumroad resource subscription.
 */
class GumroadDeleteResourceSubscription extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_delete_resource_subscription';

    protected string $toolDescription = 'Delete a Gumroad resource subscription.';

    protected string $method = 'DELETE';

    protected string $path = '/resource_subscriptions/{resource_subscription_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'resource_subscription_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Resource subscription ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'resource_subscription_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
