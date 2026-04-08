<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a file in a GitHub repository.
 */
class GitHubCreateOrUpdateFile implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_or_update_file';
    }

    public function description(): string
    {
        return 'Create a new file or update an existing file in a GitHub repository. For updates, the SHA of the existing file is required. Content should be provided as plain text (it will be base64-encoded automatically).';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The file path within the repository.'],
            'message' => ['type' => 'string', 'required' => true, 'description' => 'The commit message.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The file content as plain text. Will be base64-encoded automatically.'],
            'sha' => ['type' => 'string', 'description' => 'Required when updating an existing file. The blob SHA of the file being replaced.'],
            'branch' => ['type' => 'string', 'description' => 'The branch name. Default: the repository\'s default branch.'],
        ];
    }

    /**
     * Commit a new or updated file, base64-encoding the content automatically.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, path, message, content, sha, branch)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $path = $args['path'] ?? '';
        $message = $args['message'] ?? '';
        $content = $args['content'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($path)) {
            return ToolResult::error('File path is required.');
        }

        if (empty($message)) {
            return ToolResult::error('Commit message is required.');
        }

        if (empty($content)) {
            return ToolResult::error('File content is required.');
        }

        try {
            $params = [
                'message' => $message,
                'content' => base64_encode($content),
            ];

            if (isset($args['sha'])) {
                $params['sha'] = $args['sha'];
            }
            if (isset($args['branch'])) {
                $params['branch'] = $args['branch'];
            }

            $result = $this->service->createOrUpdateFile($owner, $repo, $path, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
