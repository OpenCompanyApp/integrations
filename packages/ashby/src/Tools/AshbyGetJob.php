<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single job from Ashby ATS.
 *
 * Retrieves full job details including title, description,
 * department, location, compensation, and application stats.
 */
class AshbyGetJob implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_get_job';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific job in Ashby, including full description, requirements, compensation, and hiring team.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The job ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Job ID is required.');
            }

            $result = $this->service->getJob($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
