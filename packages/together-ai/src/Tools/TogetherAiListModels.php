<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available models on Together AI.
 *
 * Returns a list of all models available for inference, including
 * open-source and fine-tuned models.
 */
class TogetherAiListModels implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_list_models';
    }

    public function description(): string
    {
        return 'List all available AI models on Together AI, including open-source and fine-tuned models. Returns model IDs, types, pricing, and capabilities.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
