<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a file from a GitLab project repository.
 */
class GitLabGetFile implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_get_file';
    }

    public function description(): string
    {
        return 'Get a file from a GitLab project repository. Returns file content (base64-encoded), file name, size, and encoding.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'The path of the file in the repository. Example: "README.md".'],
            'ref' => ['type' => 'string', 'required' => true, 'description' => 'The name of the branch, tag, or commit SHA.'],
        ];
    }

    /**
     * Fetch a file from the repository, decoding base64 content.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, file_path, ref)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $filePath = $args['file_path'] ?? '';
        $ref = $args['ref'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if (empty($filePath)) {
            return ToolResult::error('file_path is required.');
        }

        if (empty($ref)) {
            return ToolResult::error('ref (branch, tag, or commit SHA) is required.');
        }

        try {
            $result = $this->service->getFile($projectId, $filePath, $ref);

            // Decode base64 content for easier consumption
            if (isset($result['content']) && ($result['encoding'] ?? '') === 'base64') {
                $result['decoded_content'] = base64_decode(str_replace("\n", '', $result['content']));
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
