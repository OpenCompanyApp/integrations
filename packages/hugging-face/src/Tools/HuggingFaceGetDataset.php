<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * Get detailed information about a Hugging Face dataset.
 *
 * Returns Hub metadata, tags, downloads, card data, and file siblings when available.
 */
class HuggingFaceGetDataset implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_dataset';
    }

    public function description(): string
    {
        return 'Get detailed information about a Hugging Face dataset, including card data, tags, downloads, likes, and files.';
    }

    public function parameters(): array
    {
        return [
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Dataset ID, for example "mozilla-foundation/common_voice_17_0".'],
        ];
    }

    /**
     * Fetch dataset details from the Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments (dataset_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['dataset_id'])) {
                return ToolResult::error('dataset_id is required.');
            }

            return ToolResult::success($this->service->getDataset((string) $args['dataset_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
