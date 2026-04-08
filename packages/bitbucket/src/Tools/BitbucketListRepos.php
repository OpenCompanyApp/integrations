<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List repositories in a Bitbucket workspace.
 */
class BitbucketListRepos implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_list_repos';
    }

    public function description(): string
    {
        return 'List repositories in a Bitbucket workspace. Supports sorting and pagination.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g. "-updated_on", "name", "-created_on").'],
            'pagelen' => ['type' => 'integer', 'description' => 'Number of results per page (1-100). Default: 10.'],
            'page' => ['type' => 'string', 'description' => 'Page URL or page number for pagination.'],
        ];
    }

    /**
     * Retrieve repositories for the given workspace with optional sorting and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, sort, pagelen, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';

        if (empty($workspace)) {
            return ToolResult::error('Workspace is required.');
        }

        try {
            $params = [];

            $mapping = [
                'sort' => 'sort',
                'pagelen' => 'pagelen',
                'page' => 'page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listRepos($workspace, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
