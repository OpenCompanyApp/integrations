<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Jenkins nodes (agents).
 */
class JenkinsListNodes implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_list_nodes';
    }

    public function description(): string
    {
        return 'List all Jenkins nodes (agents), including name, offline status, and executor count.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve all Jenkins nodes.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        try {
            $result = $this->service->listNodes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
