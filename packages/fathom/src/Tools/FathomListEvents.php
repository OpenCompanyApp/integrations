<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list custom events tracked in Fathom.
 *
 * Returns a paginated list of events for a specific site, including event names
 * and associated metadata.
 */
class FathomListEvents implements Tool
{
    /**
     * Create a new FathomListEvents tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_list_events';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'List custom events tracked in Fathom Analytics for a site. Returns event names, event IDs, and configuration details.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fathom site ID (e.g., "CDCLS").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 20).'],
            'starting_after' => ['type' => 'integer', 'description' => 'Cursor for pagination — pass the ID of the last event from a previous response.'],
        ];
    }

    /**
     * Execute the tool and return a list of events.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, limit, starting_after).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $startingAfter = isset($args['starting_after']) ? (int) $args['starting_after'] : null;

            $result = $this->service->listEvents($siteId, $limit, $startingAfter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
