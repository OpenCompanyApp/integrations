<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Docker Hub repository.
 *
 * Creates a new repository under the specified namespace with optional
 * description and visibility settings.
 */
class DockerCreateRepository implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_create_repository';
    }

    public function description(): string
    {
        return 'Create a new Docker Hub repository under a namespace.';
    }

    public function parameters(): array
    {
        return [
            'namespace' => ['type' => 'string', 'required' => true, 'description' => 'Docker Hub namespace (username or organization) for the repository.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Repository name (must be unique within the namespace).'],
            'description' => ['type' => 'string', 'description' => 'Short description of the repository.'],
            'full_description' => ['type' => 'string', 'description' => 'Full description (supports Markdown).'],
            'is_private' => ['type' => 'boolean', 'description' => 'Whether the repository is private (default: false).'],
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

            $description = isset($args['description']) ? (string) $args['description'] : '';
            $fullDescription = isset($args['full_description']) ? (string) $args['full_description'] : '';
            $isPrivate = isset($args['is_private']) ? (bool) $args['is_private'] : false;

            $result = $this->service->createRepository(
                (string) $args['namespace'],
                (string) $args['name'],
                $description,
                $fullDescription,
                $isPrivate,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
