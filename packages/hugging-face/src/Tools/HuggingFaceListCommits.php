<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * List commits for a Hugging Face repository.
 *
 * Supports model, dataset, and Space repositories with slash-delimited repo IDs.
 */
class HuggingFaceListCommits implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_commits';
    }

    public function description(): string
    {
        return 'List commits for a Hugging Face model, dataset, or Space repository at a revision.';
    }

    public function parameters(): array
    {
        return [
            'repo_type' => ['type' => 'string', 'required' => true, 'enum' => ['models', 'datasets', 'spaces'], 'description' => 'Repository type. Singular values are also accepted.'],
            'repo_id' => ['type' => 'string', 'required' => true, 'description' => 'Repository ID, for example "meta-llama/Llama-3.3-70B-Instruct".'],
            'revision' => ['type' => 'string', 'description' => 'Revision, branch, or tag. Defaults to "main".'],
        ];
    }

    /**
     * Fetch commit history for a Hub repository.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repo_type, repo_id, revision)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['repo_type']) || empty($args['repo_id'])) {
                return ToolResult::error('repo_type and repo_id are required.');
            }

            return ToolResult::success($this->service->listCommits(
                (string) $args['repo_type'],
                (string) $args['repo_id'],
                (string) ($args['revision'] ?? 'main'),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
