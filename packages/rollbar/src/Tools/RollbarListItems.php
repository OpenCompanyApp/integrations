<?php

namespace OpenCompany\Integrations\Rollbar\Tools;

use OpenCompany\Integrations\Rollbar\RollbarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list error items (occurrences) in Rollbar.
 *
 * Supports filtering by project, level, status, and environment.
 * Returns paginated results with item details.
 *
 * @see https://docs.rollbar.com/docs/list-all-items
 */
class RollbarListItems implements Tool
{
    /**
     * Create a new RollbarListItems tool instance.
     */
    public function __construct(
        private RollbarService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'rollbar_list_items';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List error items in Rollbar with optional filters for project, level, status, and environment.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Filter by project ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'level' => ['type' => 'string', 'description' => 'Filter by level: debug, info, warning, error, critical.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, resolved, muted.'],
            'environment' => ['type' => 'string', 'description' => 'Filter by environment name (e.g., production, staging).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  Tool arguments (project_id, limit, offset, level, status, environment)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Rollbar integration is not configured.');
            }

            $projectId = isset($args['project_id']) ? (int) $args['project_id'] : null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $level = $args['level'] ?? null;
            $status = $args['status'] ?? null;
            $environment = $args['environment'] ?? null;

            $result = $this->service->listItems(
                projectId: $projectId,
                limit: $limit,
                offset: $offset,
                level: $level,
                status: $status,
                environment: $environment,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
