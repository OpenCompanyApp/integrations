<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the content of a file or directory from a GitHub repository.
 */
class GitHubGetFileContent implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_get_file_content';
    }

    public function description(): string
    {
        return 'Get the content of a file or directory from a GitHub repository. Returns base64-encoded content for files, or a listing for directories.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The file or directory path. Use empty string for root.'],
            'ref' => ['type' => 'string', 'description' => 'The name of the commit/branch/tag. Default: the repository\'s default branch.'],
        ];
    }

    /**
     * Fetch file or directory content, decoding base64 for files.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, path, ref)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $path = $args['path'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        try {
            $params = [];

            if (isset($args['ref'])) {
                $params['ref'] = $args['ref'];
            }

            $result = $this->service->getFileContent($owner, $repo, $path, $params);

            // Decode base64 content for files
            if (isset($result['content']) && ($result['type'] ?? '') === 'file') {
                $result['decoded_content'] = base64_decode(str_replace("\n", '', $result['content']));
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
