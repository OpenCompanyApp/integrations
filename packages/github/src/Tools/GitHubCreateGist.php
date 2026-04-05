<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new GitHub gist with one or more files.
 */
class GitHubCreateGist implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_gist';
    }

    public function description(): string
    {
        return 'Create a new GitHub gist. Provide a description, a map of filenames to their content, and whether the gist should be public or secret.';
    }

    public function parameters(): array
    {
        return [
            'description' => ['type' => 'string', 'description' => 'A description of the gist.'],
            'files' => ['type' => 'object', 'required' => true, 'description' => 'A map of filenames to file content. Each entry should have a "content" key. Example: {"hello.py": {"content": "print(\'hello\')"}}'],
            'public' => ['type' => 'boolean', 'description' => 'Whether the gist is public. Default: false (secret gist).'],
        ];
    }

    /**
     * Create a public or secret gist with the given files.
     *
     * @param  array<string, mixed>  $args  Tool arguments (description, files, public)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $files = $args['files'] ?? [];

        if (empty($files)) {
            return ToolResult::error('At least one file is required to create a gist.');
        }

        try {
            $params = [];

            $mapping = [
                'description' => 'description',
                'files' => 'files',
                'public' => 'public',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createGist($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
