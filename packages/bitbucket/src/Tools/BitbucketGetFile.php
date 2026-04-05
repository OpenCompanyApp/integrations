<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the content of a file from a Bitbucket repository.
 */
class BitbucketGetFile implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_get_file';
    }

    public function description(): string
    {
        return 'Get the raw content of a file from a Bitbucket repository at a specific revision.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'revision' => ['type' => 'string', 'required' => true, 'description' => 'A commit hash, branch name, or tag.'],
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'The path to the file within the repository.'],
        ];
    }

    /**
     * Fetch the raw content of a file at the given revision.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, revision, file_path)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $revision = $args['revision'] ?? '';
        $filePath = $args['file_path'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if (empty($revision)) {
            return ToolResult::error('revision is required.');
        }

        if (empty($filePath)) {
            return ToolResult::error('file_path is required.');
        }

        try {
            $result = $this->service->getFile($workspace, $repoSlug, $revision, $filePath);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
