<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Wipe Fathom event completion data.
 */
class FathomWipeEvent implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_wipe_event';
    }

    public function description(): string
    {
        return 'Wipe all completion data belonging to a Fathom event. This is destructive.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom event ID.'],
        ];
    }

    /**
     * Wipe event data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, event_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->wipeEvent((string) ($args['site_id'] ?? ''), (string) ($args['event_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
