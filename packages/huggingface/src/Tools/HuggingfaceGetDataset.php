<?php

namespace OpenCompany\Integrations\Huggingface\Tools;

use OpenCompany\Integrations\Huggingface\HuggingfaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Hugging Face dataset.
 *
 * Returns the full dataset card, metadata, tags, siblings (files), and usage info.
 */
class HuggingfaceGetDataset implements Tool
{
    public function __construct(
        private HuggingfaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_dataset';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Hugging Face dataset, including its card, tags, downloads, likes, and file listing.';
    }

    public function parameters(): array
    {
        return [
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'The dataset ID (e.g. "mozilla-foundation/common_voice_17_0", "imdb").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['dataset_id'])) {
                return ToolResult::error('dataset_id is required.');
            }

            $result = $this->service->getDataset($args['dataset_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
