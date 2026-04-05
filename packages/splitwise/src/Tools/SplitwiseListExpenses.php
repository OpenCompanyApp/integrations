<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseListExpenses — List shared expenses for the current user.
 *
 * Supports optional filters for group, friend, date range, and pagination.
 * Returns a paginated list of expense records from Splitwise.
 *
 * @see https://dev.splitwise.com/#get_expenses
 */
class SplitwiseListExpenses implements Tool
{
    /**
     * Create a new SplitwiseListExpenses tool instance.
     *
     * @param  SplitwiseService  $service  The Splitwise API service.
     */
    public function __construct(
        private SplitwiseService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'splitwise_list_expenses';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List shared expenses from Splitwise. Optionally filter by group, friend, or date range. Returns expense details including cost, description, category, and split information.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'integer', 'description' => 'Filter expenses by group ID.'],
            'friend_id' => ['type' => 'integer', 'description' => 'Filter expenses by friend ID.'],
            'dated_after' => ['type' => 'string', 'description' => 'Only expenses after this date (ISO 8601, e.g., "2025-01-01").'],
            'dated_before' => ['type' => 'string', 'description' => 'Only expenses before this date (ISO 8601, e.g., "2025-12-31").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of expenses to return (default: 20, max: 10000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list expenses tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (optional filters).
     * @return ToolResult The list of expenses or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            $params = [];
            $filters = ['group_id', 'friend_id', 'dated_after', 'dated_before', 'limit', 'offset'];

            foreach ($filters as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listExpenses($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
