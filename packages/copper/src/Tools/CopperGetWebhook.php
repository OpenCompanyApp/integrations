<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper webhook subscription by ID.
 */
class CopperGetWebhook extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_webhook';

    protected string $toolDescription = 'Fetch a Copper webhook subscription by ID.';

    protected string $path = '/webhooks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper webhook subscription ID.'],
    ];
}
