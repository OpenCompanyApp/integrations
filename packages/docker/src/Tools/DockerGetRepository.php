<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Docker Hub repository.
 *
 * Retrieves full details for a single repository by namespace and name,
 * including description, star count, pull count, and visibility.
 */
class DockerGetRepository implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_get_repository';
    }

    public function description(): string
    {
        return 'Get details for a specific Docker Hub repository by namespace and name.';
    }

    public function parameters(): array
    {
        return [
            'namespace' => ['type' => 'string', 'required' => true, 'description' => 'The Docker Hub namespace (username or organization).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The repository name.'],
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

            $result = $this->service->getRepository((string) $args['namespace'], (string) $args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
