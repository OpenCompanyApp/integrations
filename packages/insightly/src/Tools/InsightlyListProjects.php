<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Projects
 *
 * Lists projects from Insightly CRM with optional pagination and status filtering.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Projects/GetEntities
 */
class InsightlyListProjects implements Tool
{
    /**
     * Create a new InsightlyListProjects tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_list_projects';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List projects from Insightly CRM. Returns project records with names, statuses, dates, and linked records. Use top/skip for pagination and status to filter by project state.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of projects to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of projects to skip for pagination.'],
            'status' => ['type' => 'string', 'description' => 'Filter by project status (e.g., "In Progress", "Completed", "Scheduled").'],
        ];
    }

    /**
     * Execute the list projects tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, status).
     * @return ToolResult The list of projects or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            $result = $this->service->listProjects(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success([
                'projects' => $result,
                'count' => count($result),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
