<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recent pipelines for a CircleCI organization.
 *
 * Returns a paginated list of pipelines, optionally filtered by branch.
 * Use orgSlug to scope results to a specific organization (e.g., "gh/my-org").
 */
class CircleCIListPipelines implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_list_pipelines';
    }

    public function description(): string
    {
        return 'List recent CI/CD pipelines in CircleCI. Filter by organization slug and branch. Returns pipeline IDs, status, trigger information, and revision details.';
    }

    public function parameters(): array
    {
        return [
            'orgSlug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug (e.g., "gh/my-org" for GitHub, "bb/my-org" for Bitbucket).'],
            'branch' => ['type' => 'string', 'description' => 'Filter pipelines by branch name (e.g., "main", "develop").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pipelines to return (default: 20, max: 100).'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $params = [
                'org-slug' => $args['orgSlug'],
            ];

            if (isset($args['branch'])) {
                $params['branch'] = $args['branch'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['page_token'])) {
                $params['page-token'] = $args['page_token'];
            }

            $result = $this->service->listPipelines($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
