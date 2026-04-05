<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve details for a specific Workable job.
 *
 * Returns full job details including title, description, requirements,
 * benefits, location, employment type, and application URL.
 */
class WorkableGetJob implements Tool
{
    /**
     * Create a new WorkableGetJob tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_get_job';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details for a specific job in Workable by its shortcode. Returns title, description, requirements, location, employment type, salary, and application URL.';
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
        ];
    }

    /**
     * Execute the get job request.
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

            $result = $this->service->getJob($args['shortcode']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
