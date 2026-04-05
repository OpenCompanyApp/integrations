<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Projects
 *
 * Lists projects from Insightly CRM with optional pagination, ordering, and filtering.
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
        return 'List projects from Insightly CRM. Returns project records with names, statuses, dates, and linked records. Use pagination parameters to browse large result sets.';
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
            'order_by' => ['type' => 'string', 'description' => 'Field to order by (e.g., "DATE_CREATED_UTC desc").'],
            'filter' => ['type' => 'string', 'description' => 'Insightly filter expression (e.g., "STATUS eq \'In Progress\'").'],
            'brief' => ['type' => 'boolean', 'description' => 'Set to true for a reduced payload with only key fields.'],
        ];
    }

    /**
     * Execute the list projects tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, order_by, filter, brief).
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
                brief: isset($args['brief']) ? ($args['brief'] ? 'true' : null) : null,
                orderBy: $args['order_by'] ?? null,
                filter: $args['filter'] ?? null,
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
