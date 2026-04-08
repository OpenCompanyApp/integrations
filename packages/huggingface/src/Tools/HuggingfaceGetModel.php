<?php

namespace OpenCompany\Integrations\Huggingface\Tools;

use OpenCompany\Integrations\Huggingface\HuggingfaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Hugging Face model.
 *
 * Returns the full model card, metadata, tags, siblings (files), and pipeline info.
 */
class HuggingfaceGetModel implements Tool
{
    public function __construct(
        private HuggingfaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_model';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Hugging Face model, including its card, tags, pipeline tag, library, downloads, likes, and file listing.';
    }

    public function parameters(): array
    {
        return [
            'model_id' => ['type' => 'string', 'required' => true, 'description' => 'The model ID (e.g. "meta-llama/Llama-3.3-70B-Instruct", "bert-base-uncased").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['model_id'])) {
                return ToolResult::error('model_id is required.');
            }

            $result = $this->service->getModel($args['model_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
