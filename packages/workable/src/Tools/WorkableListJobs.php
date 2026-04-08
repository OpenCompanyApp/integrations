<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list jobs from the Workable ATS.
 *
 * Supports pagination and optional filtering by job state
 * (published, draft, closed, archived).
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
     * Get the tool name.
     */
    public function name(): string
    {
        return 'workable_list_jobs';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List jobs from your Workable account. Optionally filter by state (published, draft, closed, archived). Returns paginated results with job titles, shortcodes, and statuses.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'state' => ['type' => 'string', 'description' => 'Filter by job state: "published", "draft", "closed", or "archived". Omit to list all jobs.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the tool and return the list of jobs.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $state = $args['state'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : null;

            $result = $this->service->listJobs($state, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
