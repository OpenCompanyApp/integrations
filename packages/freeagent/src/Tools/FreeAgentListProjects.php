<?php

namespace OpenCompany\Integrations\FreeAgent\Tools;

use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects from FreeAgent.
 */
class FreeAgentListProjects implements Tool
{
    /**
     * Create a new FreeAgentListProjects tool instance.
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
        return 'freeagent_list_projects';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List projects from FreeAgent. Returns project names, status, budget, associated contacts, and time tracking information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'view' => ['type' => 'string', 'description' => 'Filter view: "all" (default), "active", "completed", "cancelled", "unquoted".'],
            'contact' => ['type' => 'string', 'description' => 'Filter by contact URL or ID.'],
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
            $filters = ['view', 'contact', 'page', 'per_page'];

            foreach ($filters as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
