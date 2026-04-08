<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Jenkins build.
 */
class JenkinsGetBuild implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_get_build';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Jenkins build, including result, duration, console output, artifacts, and change sets.';
    }

    public function parameters(): array
    {
        return [
            'job_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Jenkins job.'],
            'build_number' => ['type' => 'integer', 'required' => true, 'description' => 'The build number.'],
        ];
    }

    /**
     * Retrieve details for a specific Jenkins build.
     *
     * @param  array<string, mixed>  $args  Tool arguments (job_name, build_number)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        $jobName = $args['job_name'] ?? '';
        $buildNumber = $args['build_number'] ?? null;

        if (empty($jobName)) {
            return ToolResult::error('Job name is required.');
        }

        if ($buildNumber === null) {
            return ToolResult::error('Build number is required.');
        }

        try {
            $result = $this->service->getBuild($jobName, (int) $buildNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
