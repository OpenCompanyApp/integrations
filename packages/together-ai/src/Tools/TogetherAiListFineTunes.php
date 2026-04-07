<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List fine-tuning jobs on Together AI.
 *
 * Returns all fine-tuning jobs associated with the authenticated account,
 * including their status, model, and training configuration.
 */
class TogetherAiListFineTunes implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_list_fine_tunes';
    }

    public function description(): string
    {
        return 'List all fine-tuning jobs on Together AI. Returns job IDs, status, base model, training file, and creation timestamps.';
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

            $result = $this->service->listFineTunes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
