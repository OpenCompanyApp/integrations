<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List builds for a specific Jenkins job.
 */
class JenkinsListBuilds implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_list_builds';
    }

    public function description(): string
    {
        return 'List builds for a specific Jenkins job, including build numbers, results, durations, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'job_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Jenkins job.'],
            'status' => ['type' => 'string', 'description' => 'Filter by build status: SUCCESS, FAILURE, UNSTABLE, ABORTED, IN_PROGRESS.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of builds to return. Default: 20.'],
        ];
    }

    /**
     * Retrieve builds for a specific Jenkins job.
     *
     * @param  array<string, mixed>  $args  Tool arguments (job_name, status, per_page)
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
            $params = [];

            $mapping = [
                'status' => 'status',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listBuilds($jobName, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
