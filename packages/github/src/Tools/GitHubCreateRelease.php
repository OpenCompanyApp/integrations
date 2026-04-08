<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new release in a GitHub repository.
 */
class GitHubCreateRelease implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_release';
    }

    public function description(): string
    {
        return 'Create a new release in a GitHub repository. Requires a tag name. Optionally set target commit, release name, body, draft, and prerelease flags.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'tag_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the tag for the release (e.g. "v1.0.0").'],
            'target_commitish' => ['type' => 'string', 'description' => 'The commitish value that determines where the Git tag is created from. Can be a branch or SHA. Default: default branch.'],
            'name' => ['type' => 'string', 'description' => 'The name of the release.'],
            'body' => ['type' => 'string', 'description' => 'The release body text describing the release. Supports GitHub Markdown.'],
            'draft' => ['type' => 'boolean', 'description' => 'Whether to create the release as a draft. Default: false.'],
            'prerelease' => ['type' => 'boolean', 'description' => 'Whether to identify the release as a prerelease. Default: false.'],
        ];
    }

    /**
     * Create a release for a given tag with optional draft and prerelease flags.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, tag_name, target_commitish, name, body, draft, prerelease)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $tagName = $args['tag_name'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($tagName)) {
            return ToolResult::error('tag_name is required.');
        }

        try {
            $params = [];

            $mapping = [
                'tag_name' => 'tag_name',
                'target_commitish' => 'target_commitish',
                'name' => 'name',
                'body' => 'body',
                'draft' => 'draft',
                'prerelease' => 'prerelease',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createRelease($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
