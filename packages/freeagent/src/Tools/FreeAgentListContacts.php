<?php

namespace OpenCompany\Integrations\FreeAgent\Tools;

use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts from FreeAgent.
 */
class FreeAgentListContacts implements Tool
{
    /**
     * Create a new FreeAgentListContacts tool instance.
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
        return 'freeagent_list_contacts';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List contacts from FreeAgent. Returns a paginated list of contacts including customers, suppliers, and employees. Supports filtering and sorting.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'view' => ['type' => 'string', 'description' => 'Filter view: "all" (default), "customers", "suppliers", "active", "inactive".'],
            'order' => ['type' => 'string', 'description' => 'Sort order: "name", "created_at", "updated_at". Prefix with "-" for descending.'],
            'created_since' => ['type' => 'string', 'description' => 'Only contacts created after this date (ISO 8601).'],
            'updated_since' => ['type' => 'string', 'description' => 'Only contacts updated after this date (ISO 8601).'],
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
            $filters = ['view', 'order', 'created_since', 'updated_since', 'page', 'per_page'];

            foreach ($filters as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
