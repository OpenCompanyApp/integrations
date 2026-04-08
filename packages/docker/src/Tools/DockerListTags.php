<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tags for a Docker Hub repository.
 *
 * Returns a paginated list of tags for the specified repository.
 * Use `page_size` and `page` parameters to control pagination.
 */
class DockerListTags implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_list_tags';
    }

    public function description(): string
    {
        return 'List tags for a Docker Hub repository. Supports pagination with page_size and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'namespace' => ['type' => 'string', 'required' => true, 'description' => 'The Docker Hub namespace (username or organization).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The repository name.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of tags per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Docker Hub integration is not configured.');
            }

            if (empty($args['namespace'])) {
                return ToolResult::error('Namespace is required.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Repository name is required.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listTags(
                (string) $args['namespace'],
                (string) $args['name'],
                $pageSize,
                $page,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
