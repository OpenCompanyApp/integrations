<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\JinaAI\JinaAIService;

/**
 * Classify inputs with Jina AI Classifier.
 *
 * Supports zero-shot labels and few-shot classifier identifiers through the upstream classify endpoint.
 */
class JinaAIClassify implements Tool
{
    /**
     * @param  JinaAIService  $service  The Jina AI API client.
     */
    public function __construct(
        private JinaAIService $service,
    ) {}

    public function name(): string
    {
        return 'jinaai_classify';
    }

    public function description(): string
    {
        return 'Classify text or image inputs using Jina AI Classifier. Provide labels for zero-shot classification or classifier configuration for few-shot classification.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'array', 'required' => true, 'description' => 'Inputs to classify. Text inputs may be strings or objects accepted by Jina.'],
            'labels' => ['type' => 'array', 'description' => 'Zero-shot classification labels.'],
            'model' => ['type' => 'string', 'description' => 'Embedding or classifier model id.'],
            'classifier_id' => ['type' => 'string', 'description' => 'Few-shot classifier id when using a trained classifier.'],
            'top_k' => ['type' => 'integer', 'description' => 'Maximum labels per input to return.'],
        ];
    }

    /**
     * Classify inputs with the configured Jina AI account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            if (empty($args['input'])) {
                return ToolResult::error('input is required.');
            }

            $body = ['input' => $args['input']];
            foreach (['labels', 'model', 'classifier_id', 'top_k'] as $key) {
                if (array_key_exists($key, $args)) {
                    $body[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->classify($body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
