<?php

namespace OpenCompany\Integrations\FreeAgent\Tools;

use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List expenses from FreeAgent.
 */
class FreeAgentListExpenses implements Tool
{
    /**
     * Create a new FreeAgentListExpenses tool instance.
     *
     * @param  FreeAgentService  $service  The FreeAgent service for making API calls.
     */
    public function __construct(
        private FreeAgentService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freeagent_list_expenses';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List expenses from FreeAgent. Returns expense claims with amounts, categories, dates, and associated projects or contacts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'from_date' => ['type' => 'string', 'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01").'],
            'to_date' => ['type' => 'string', 'description' => 'End date for filtering (ISO 8601, e.g., "2025-12-31").'],
            'contact' => ['type' => 'string', 'description' => 'Filter by contact URL or ID.'],
            'project' => ['type' => 'string', 'description' => 'Filter by project URL or ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 30).'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreeAgent integration is not configured.');
            }

            $params = [];
            $filters = ['from_date', 'to_date', 'contact', 'project', 'page', 'per_page'];

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
