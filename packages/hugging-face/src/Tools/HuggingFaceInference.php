<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Run inference on a Hugging Face model via the Inference API.
 *
 * Supports text generation, text classification, summarization, translation,
 * image classification, speech recognition, and many other tasks.
 * The payload format depends on the model's pipeline task.
 *
 * @see https://huggingface.co/docs/api-inference
 */
class HuggingFaceInference implements Tool
{
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_inference';
    }

    public function description(): string
    {
        return 'Run inference on a Hugging Face model via the serverless Inference API. Supports text generation, summarization, translation, classification, image analysis, and more. The payload structure depends on the model\'s task — refer to the Hugging Face Inference API docs for model-specific formats.';
    }

    public function parameters(): array
    {
        return [
            'model_id' => ['type' => 'string', 'required' => true, 'description' => 'The model ID to run inference on (e.g. "meta-llama/Llama-3.3-70B-Instruct", "facebook/bart-large-cnn").'],
            'inputs' => ['type' => 'string', 'description' => 'The input text or data for the model. For text tasks, this is the prompt or text to process.'],
            'parameters' => ['type' => 'object', 'description' => 'Model-specific parameters (e.g. {"max_new_tokens": 256, "temperature": 0.7, "top_p": 0.95} for text generation).'],
            'data' => ['type' => 'string', 'description' => 'Base64-encoded data for image/audio tasks. Use this instead of "inputs" for non-text models.'],
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

            $payload = [];

            if (isset($args['inputs'])) {
                $payload['inputs'] = $args['inputs'];
            } elseif (isset($args['data'])) {
                $payload['inputs'] = $args['data'];
            }

            if (isset($args['parameters']) && is_array($args['parameters'])) {
                $payload['parameters'] = $args['parameters'];
            }

            $result = $this->service->inference($args['model_id'], $payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
