<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Docker Hub repositories for a namespace.
 *
 * Returns a paginated list of repositories on the authenticated Docker Hub account.
 * Use the `namespace` parameter to filter by user or organization, and
 * `page_size` and `page` to control pagination.
 */
class DockerListRepositories implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_list_repositories';
    }

    public function description(): string
    {
        return 'List Docker Hub repositories. Optionally filter by namespace. Supports pagination with page_size and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'namespace' => ['type' => 'string', 'description' => 'Docker Hub namespace (username or organization) to filter by.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of repositories per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Docker Hub integration is not configured.');
            }

            $namespace = isset($args['namespace']) ? (string) $args['namespace'] : '';
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listRepositories($namespace, $pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
