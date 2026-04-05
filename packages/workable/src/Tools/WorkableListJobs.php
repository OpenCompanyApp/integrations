<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list jobs in the Workable ATS.
 *
 * Returns a paginated list of jobs, optionally filtered by state
 * (e.g., published, draft, archived, closed).
 */
class WorkableListJobs implements Tool
{
    /**
     * Create a new WorkableListJobs tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_list_jobs';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List jobs in your Workable account. Optionally filter by state (published, draft, archived, closed). Returns job titles, shortcodes, states, and locations.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'state' => ['type' => 'string', 'description' => 'Filter by job state: "published", "draft", "archived", or "closed". Omit to list all jobs.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of jobs to return (default: 50).'],
        ];
    }

    /**
     * Execute the list jobs request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $state = $args['state'] ?? null;

            $result = $this->service->listJobs($state, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
