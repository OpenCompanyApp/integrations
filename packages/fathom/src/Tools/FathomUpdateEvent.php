<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Update a Fathom event.
 */
class FathomUpdateEvent implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_update_event';
    }

    public function description(): string
    {
        return 'Update a Fathom event name.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom event ID.'],
            'name' => ['type' => 'string', 'description' => 'Updated event name.'],
        ];
    }

    /**
     * Update an event.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, event_id, name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->updateEvent((string) ($args['site_id'] ?? ''), (string) ($args['event_id'] ?? ''), array_intersect_key($args, ['name' => true])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
