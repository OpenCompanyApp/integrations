<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper webhook subscription.
 */
class CopperDeleteWebhook extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_webhook';

    protected string $toolDescription = 'Delete a Copper webhook subscription.';

    protected string $method = 'DELETE';

    protected string $path = '/webhooks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper webhook subscription ID to delete.'],
    ];
}
