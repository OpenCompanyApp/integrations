<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Argo CD applications.
 */
class ArgoCdListApplications implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_list_applications';
    }

    public function description(): string
    {
        return 'List all Argo CD applications. Optionally filter by project or label selector.';
    }

    public function parameters(): array
    {
        return [
            'project' => ['type' => 'string', 'description' => 'Filter applications by project name.'],
            'selector' => ['type' => 'string', 'description' => 'Label selector to filter applications (e.g. "env=production").'],
            'repo' => ['type' => 'string', 'description' => 'Filter by source repository URL.'],
        ];
    }

    /**
     * List Argo CD applications with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project, selector, repo)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        try {
            $params = [];

            if (! empty($args['project'])) {
                $params['project'] = $args['project'];
            }

            if (! empty($args['selector'])) {
                $params['selector'] = $args['selector'];
            }

            if (! empty($args['repo'])) {
                $params['repo'] = $args['repo'];
            }

            $result = $this->service->listApplications($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
