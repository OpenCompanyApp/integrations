<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Workable job by shortcode.
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
     * Get the tool name.
     */
    public function name(): string
    {
        return 'workable_get_job';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details for a specific Workable job by its shortcode. Returns title, description, department, location, employment type, salary, and application counts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'shortcode' => ['type' => 'string', 'required' => true, 'description' => 'The job shortcode identifier (e.g., "GROVF002").'],
        ];
    }

    /**
     * Execute the tool and return the job details.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $shortcode = $args['shortcode'] ?? '';

            if (empty($shortcode)) {
                return ToolResult::error('The "shortcode" parameter is required.');
            }

            $result = $this->service->getJob($shortcode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
