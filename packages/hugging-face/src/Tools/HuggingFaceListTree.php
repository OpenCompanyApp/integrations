<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * List files and folders in a Hugging Face repository.
 *
 * Supports model, dataset, and Space repository tree endpoints.
 */
class HuggingFaceListTree implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_tree';
    }

    public function description(): string
    {
        return 'List repository tree contents for a model, dataset, or Space at a revision and optional nested path.';
    }

    public function parameters(): array
    {
        return [
            'repo_type' => ['type' => 'string', 'required' => true, 'enum' => ['models', 'datasets', 'spaces'], 'description' => 'Repository type. Singular values are also accepted.'],
            'repo_id' => ['type' => 'string', 'required' => true, 'description' => 'Repository ID.'],
            'revision' => ['type' => 'string', 'description' => 'Revision, branch, or tag. Defaults to "main".'],
            'path' => ['type' => 'string', 'description' => 'Nested folder path inside the repository.'],
            'params' => ['type' => 'object', 'description' => 'Optional Hub API query parameters, such as recursive or expand when supported.'],
        ];
    }

    /**
     * Fetch repository tree contents.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repo_type, repo_id, revision, path, params)
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

            return ToolResult::success($this->service->listTree(
                (string) $args['repo_type'],
                (string) $args['repo_id'],
                (string) ($args['revision'] ?? 'main'),
                (string) ($args['path'] ?? ''),
                is_array($args['params'] ?? null) ? $args['params'] : [],
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
