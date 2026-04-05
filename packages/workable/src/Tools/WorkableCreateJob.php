<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new job posting in Workable.
 */
class WorkableCreateJob implements Tool
{
    /**
     * Create a new WorkableCreateJob tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'workable_create_job';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new job posting in Workable. Specify the title, description, department, and employment type. The job is created in draft state by default.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Job title (e.g., "Senior Backend Engineer").'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Full job description in HTML or plain text.'],
            'department' => ['type' => 'string', 'description' => 'Department name (e.g., "Engineering").'],
            'employment_type' => ['type' => 'string', 'description' => 'Employment type: "full-time", "part-time", "contract", "temporary", "intern".'],
        ];
    }

    /**
     * Execute the tool and create the job.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $title = $args['title'] ?? '';
            $description = $args['description'] ?? '';

            if (empty($title)) {
                return ToolResult::error('The "title" parameter is required.');
            }

            if (empty($description)) {
                return ToolResult::error('The "description" parameter is required.');
            }

            $data = [
                'title' => $title,
                'description' => $description,
            ];

            if (isset($args['department'])) {
                $data['department'] = $args['department'];
            }

            if (isset($args['employment_type'])) {
                $data['employment_type'] = $args['employment_type'];
            }

            $result = $this->service->createJob($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
