<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recent Replicate predictions.
 *
 * Returns a list of predictions with their status, model version, input,
 * output, and other metadata. Useful for monitoring running or completed jobs.
 */
class ReplicateListPredictions implements Tool
{
    public function __construct(
        private ReplicateService $service,
    ) {}

    public function name(): string
    {
        return 'replicate_list_predictions';
    }

    public function description(): string
    {
        return 'List recent Replicate predictions. Returns prediction IDs, statuses, model versions, and outputs.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
            }

            $result = $this->service->listPredictions();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
