<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific fine-tuning job on Together AI.
 *
 * Returns the full details of a fine-tuning job including status,
 * training metrics, model configuration, and output model ID.
 */
class TogetherAiGetFineTune implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_get_fine_tune';
    }

    public function description(): string
    {
        return 'Get details of a specific fine-tuning job on Together AI. Returns status, training progress, hyperparameters, and the output model ID once complete.';
    }

    public function parameters(): array
    {
        return [
            'fine_tune_id' => ['type' => 'string', 'required' => true, 'description' => 'The fine-tuning job ID (e.g. "ft-abc123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            if (empty($args['fine_tune_id'])) {
                return ToolResult::error('fine_tune_id is required.');
            }

            $result = $this->service->getFineTune($args['fine_tune_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
