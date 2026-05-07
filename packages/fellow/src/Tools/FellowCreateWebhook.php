<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Fellow webhook endpoint.
 */
class FellowCreateWebhook extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_create_webhook';
    }

    public function description(): string
    {
        return 'Create a Fellow webhook endpoint for supported event types.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Webhook destination URL.'],
            'enabled_events' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Event types to subscribe to.'],
            'description' => ['type' => 'string', 'description' => 'Optional webhook description.'],
            'status' => ['type' => 'string', 'enum' => ['active', 'inactive'], 'description' => 'Webhook status.'],
        ];
    }

    /**
     * Execute the create webhook tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $this->requiredString($args, 'url');

            if (empty($args['enabled_events']) || ! is_array($args['enabled_events'])) {
                throw new \InvalidArgumentException('enabled_events is required.');
            }

            return $this->service->createWebhook($this->body($args, [
                'url',
                'enabled_events',
                'description',
                'status',
            ]));
        });
    }
}
