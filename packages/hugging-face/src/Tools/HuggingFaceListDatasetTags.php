<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * List Hugging Face dataset tags grouped by tag type.
 *
 * Useful for building reliable dataset search filters.
 */
class HuggingFaceListDatasetTags implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_dataset_tags';
    }

    public function description(): string
    {
        return 'List Hugging Face dataset tags grouped by type, such as task category, language, modality, and license.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch dataset tag metadata from the Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            return ToolResult::success($this->service->listDatasetTags());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
