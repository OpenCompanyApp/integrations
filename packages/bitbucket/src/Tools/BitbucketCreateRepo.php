<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new repository in a Bitbucket workspace.
 */
class BitbucketCreateRepo implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_create_repo';
    }

    public function description(): string
    {
        return 'Create a new repository in a Bitbucket workspace. Optionally set description, visibility, and language.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The slug for the new repository.'],
            'description' => ['type' => 'string', 'description' => 'A short description of the repository.'],
            'is_private' => ['type' => 'boolean', 'description' => 'Whether the repository should be private. Default: true.'],
            'language' => ['type' => 'string', 'description' => 'The main language of the repository (e.g. "python", "javascript").'],
        ];
    }

    /**
     * Create a repository with optional description, visibility, and language.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, description, is_private, language)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        try {
            $params = [];

            $mapping = [
                'description' => 'description',
                'is_private' => 'is_private',
                'language' => 'language',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createRepo($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
