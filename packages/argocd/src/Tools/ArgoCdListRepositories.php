<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all configured Git repositories in Argo CD.
 */
class ArgoCdListRepositories implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_list_repositories';
    }

    public function description(): string
    {
        return 'List all configured Git repositories in Argo CD, including connection status.';
    }

    public function parameters(): array
    {
        return [
            'repo' => ['type' => 'string', 'description' => 'Filter by repository URL.'],
        ];
    }

    /**
     * List Argo CD repositories.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repo)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        try {
            $params = [];

            if (! empty($args['repo'])) {
                $params['repo'] = $args['repo'];
            }

            $result = $this->service->listRepositories($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
