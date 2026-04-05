<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing available MistralAI models.
 *
 * Retrieves all models accessible with the configured API key,
 * including chat, embedding, and fine-tuned models.
 */
class MistralAIListModels implements Tool
{
    /**
     * Create a new MistralAIListModels tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_list_models';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List all models available in your MistralAI account. Returns model IDs, creation timestamps, and capabilities. Use this to discover which models you can use for chat completions or embeddings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list models request.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MistralAI integration is not configured.');
            }

            $result = $this->service->listModels();

            $models = $result['data'] ?? [];

            $response = [
                'models' => array_map(function (array $model): array {
                    return [
                        'id' => $model['id'] ?? '',
                        'object' => $model['object'] ?? 'model',
                        'created' => $model['created'] ?? null,
                        'owned_by' => $model['owned_by'] ?? null,
                    ];
                }, $models),
                'total' => count($models),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
