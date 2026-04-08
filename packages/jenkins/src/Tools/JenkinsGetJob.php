<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Jenkins job.
 */
class JenkinsGetJob implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_get_job';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Jenkins job, including description, last build, health reports, and parameters.';
    }

    public function parameters(): array
    {
        return [
            'job_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Jenkins job.'],
        ];
    }

    /**
     * Retrieve details for a specific Jenkins job.
     *
     * @param  array<string, mixed>  $args  Tool arguments (job_name)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        $jobName = $args['job_name'] ?? '';

        if (empty($jobName)) {
            return ToolResult::error('Job name is required.');
        }

        try {
            $result = $this->service->getJob($jobName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
