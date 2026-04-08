<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Jenkins jobs.
 */
class JenkinsListJobs implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_list_jobs';
    }

    public function description(): string
    {
        return 'List all Jenkins jobs. Returns job names, URLs, colors (build status), and basic metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve all Jenkins jobs.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        try {
            $result = $this->service->listJobs();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
