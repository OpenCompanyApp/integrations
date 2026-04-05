<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Fellow action items with pagination.
 */
class FellowListActionItems implements Tool
{
    /**
     * Create a new FellowListActionItems tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_list_action_items';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List action items from Fellow. Supports cursor-based pagination and optional status filtering. Returns action item titles, assignees, due dates, and completion status.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of action items to return per page (default: 25).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status (e.g., "open", "completed").'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
            }

            $params = [];

            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listActionItems($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
