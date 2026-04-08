<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available OpenAI models.
 *
 * Returns a list of all models available to the authenticated user,
 * including model IDs, ownership, and creation timestamps.
 */
class OpenAIListModels implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_list_models';
    }

    public function description(): string
    {
        return 'List all models available from OpenAI, including GPT, DALL·E, Whisper, and embedding models.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List available models.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $result = $this->service->listModels();

            $models = $result['data'] ?? [];

            return ToolResult::success([
                'object' => $result['object'] ?? '',
                'data' => $models,
                'count' => count($models),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
