<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Hugging Face model.
 *
 * Returns the full model card, metadata, tags, siblings (files), and pipeline info.
 */
class HuggingFaceGetModel implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
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

    /**
     * Fetch model details from the Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model_id)
     */
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
