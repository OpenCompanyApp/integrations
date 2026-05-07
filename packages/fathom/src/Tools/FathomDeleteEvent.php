<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Delete a Fathom event.
 */
class FathomDeleteEvent implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_delete_event';
    }

    public function description(): string
    {
        return 'Delete a Fathom event. This is destructive and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom event ID.'],
        ];
    }

    /**
     * Delete an event.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, event_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->deleteEvent((string) ($args['site_id'] ?? ''), (string) ($args['event_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
