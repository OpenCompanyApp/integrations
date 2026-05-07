<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper webhook subscription.
 */
class CopperUpdateWebhook extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_webhook';

    protected string $toolDescription = 'Update a Copper webhook subscription.';

    protected string $method = 'PUT';

    protected string $path = '/webhooks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['target', 'type', 'event', 'secret'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper webhook subscription ID.'],
        'target' => ['type' => 'string', 'description' => 'Webhook target URL.'],
        'type' => ['type' => 'string', 'description' => 'Entity type.'],
        'event' => ['type' => 'string', 'description' => 'Event name.'],
        'secret' => ['type' => 'string', 'description' => 'Optional shared secret.'],
    ];
}
