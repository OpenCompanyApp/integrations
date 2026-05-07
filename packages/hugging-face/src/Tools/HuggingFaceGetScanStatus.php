<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * Get repository security scan status from Hugging Face.
 *
 * Supports model, dataset, and Space repository scan endpoints.
 */
class HuggingFaceGetScanStatus implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_scan_status';
    }

    public function description(): string
    {
        return 'Get the Hugging Face Hub security scan status for a model, dataset, or Space repository.';
    }

    public function parameters(): array
    {
        return [
            'repo_type' => ['type' => 'string', 'required' => true, 'enum' => ['models', 'datasets', 'spaces'], 'description' => 'Repository type. Singular values are also accepted.'],
            'repo_id' => ['type' => 'string', 'required' => true, 'description' => 'Repository ID.'],
        ];
    }

    /**
     * Fetch scan status for a Hub repository.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repo_type, repo_id)
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

            return ToolResult::success($this->service->getScanStatus((string) $args['repo_type'], (string) $args['repo_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
