<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list candidates for a specific Workable job.
 *
 * Returns a paginated list of candidates including names, emails,
 * stages, and application dates.
 */
class WorkableListCandidates implements Tool
{
    /**
     * Create a new WorkableListCandidates tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_list_candidates';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List candidates for a specific job in Workable. Returns candidate names, emails, current stage, and application dates.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'shortcode' => ['type' => 'string', 'required' => true, 'description' => 'The job shortcode (e.g., "GRO-001"). Find shortcodes using the list_jobs tool.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of candidates to return (default: 50).'],
        ];
    }

    /**
     * Execute the list candidates request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            if (empty($args['shortcode'])) {
                return ToolResult::error('The shortcode parameter is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;

            $result = $this->service->listCandidates($args['shortcode'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
