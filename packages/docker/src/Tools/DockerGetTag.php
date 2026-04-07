<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific tag in a Docker Hub repository.
 *
 * Retrieves full details for a single tag, including digest, size,
 * and image manifest information.
 */
class DockerGetTag implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_get_tag';
    }

    public function description(): string
    {
        return 'Get details for a specific tag in a Docker Hub repository.';
    }

    public function parameters(): array
    {
        return [
            'namespace' => ['type' => 'string', 'required' => true, 'description' => 'The Docker Hub namespace (username or organization).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The repository name.'],
            'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag name (e.g., "latest", "1.0.0").'],
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

            if (empty($args['tag'])) {
                return ToolResult::error('Tag name is required.');
            }

            $result = $this->service->getTag(
                (string) $args['namespace'],
                (string) $args['name'],
                (string) $args['tag'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
