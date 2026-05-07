<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Fellow webhook endpoint.
 */
class FellowUpdateWebhook extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_update_webhook';
    }

    public function description(): string
    {
        return 'Update a Fellow webhook endpoint with partial fields.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow webhook ID.'],
            'payload' => ['type' => 'object', 'description' => 'Raw webhook update body.'],
            'url' => ['type' => 'string', 'description' => 'Webhook destination URL.'],
            'enabled_events' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Event types to subscribe to.'],
            'description' => ['type' => 'string', 'description' => 'Webhook description.'],
            'status' => ['type' => 'string', 'enum' => ['active', 'inactive'], 'description' => 'Webhook status.'],
        ];
    }

    /**
     * Execute the update webhook tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateWebhook(
            $this->requiredString($args, 'webhook_id'),
            $this->body($args, ['url', 'enabled_events', 'description', 'status']),
        ));
    }
}
