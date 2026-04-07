<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Argo CD projects.
 */
class ArgoCdListProjects implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_list_projects';
    }

    public function description(): string
    {
        return 'List all Argo CD projects.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Argo CD projects.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        try {
            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
