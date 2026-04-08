<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new repository for the authenticated GitHub user.
 */
class GitHubCreateRepo implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_repo';
    }

    public function description(): string
    {
        return 'Create a new repository for the authenticated GitHub user. Optionally set description, visibility, and auto-initialize with a README.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the new repository.'],
            'description' => ['type' => 'string', 'description' => 'A short description of the repository.'],
            'private' => ['type' => 'boolean', 'description' => 'Whether the repository should be private. Default: false (public).'],
            'auto_init' => ['type' => 'boolean', 'description' => 'Initialize the repository with a README.md. Default: false.'],
        ];
    }

    /**
     * Create a repository with optional description, visibility, and README initialization.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, description, private, auto_init)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Repository name is required.');
        }

        try {
            $params = [];

            $mapping = [
                'name' => 'name',
                'description' => 'description',
                'private' => 'private',
                'auto_init' => 'auto_init',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createRepo($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
