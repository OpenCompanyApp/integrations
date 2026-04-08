<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Jenkins job.
 */
class JenkinsCreateJob implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_create_job';
    }

    public function description(): string
    {
        return 'Create a new Jenkins job. Requires a job name and configuration.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new Jenkins job.'],
            'mode' => ['type' => 'string', 'description' => 'Job type: freestyle, pipeline, maven, matrix, or multibranch. Default: freestyle.'],
            'description' => ['type' => 'string', 'description' => 'A description for the job.'],
            'config' => ['type' => 'object', 'description' => 'Job configuration as a structured object (e.g. SCM, builders, publishers).'],
        ];
    }

    /**
     * Create a new Jenkins job.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, mode, description, config)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Job name is required.');
        }

        try {
            $params = [];

            $mapping = [
                'name' => 'name',
                'mode' => 'mode',
                'description' => 'description',
                'config' => 'config',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createJob($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
