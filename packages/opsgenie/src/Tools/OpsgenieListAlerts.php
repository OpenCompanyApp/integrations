<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Opsgenie alerts with optional filtering.
 *
 * Supports filtering by query, status, priority, and pagination via limit/offset.
 */
class OpsgenieListAlerts implements Tool
{
    /**
     * Create a new OpsgenieListAlerts tool instance.
     *
     * @param  OpsgenieService  $service  The Opsgenie API service
     */
    public function __construct(
        private OpsgenieService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'opsgenie_list_alerts';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Opsgenie alerts. Optionally filter by query, status, or priority. Returns alert IDs, messages, statuses, and priorities.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query to filter alerts (e.g., "status:open AND priority:P1").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of alerts to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g., "createdAt", "updatedAt").'],
            'order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc" (default: "desc").'],
        ];
    }

    /**
     * Execute the tool and return the list of alerts.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $params = [];

            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            if (isset($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listAlerts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
