<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Replicate prediction.
 *
 * Returns full prediction details including status, input, output, logs,
 * error messages, and timing information for a single prediction by its ID.
 */
class ReplicateGetPrediction implements Tool
{
    public function __construct(
        private ReplicateService $service,
    ) {}

    public function name(): string
    {
        return 'replicate_get_prediction';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Replicate prediction by its ID, including status, output, logs, and error details.';
    }

    public function parameters(): array
    {
        return [
            'prediction_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique prediction identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
            }

            if (empty($args['prediction_id'])) {
                return ToolResult::error('prediction_id is required.');
            }

            $result = $this->service->getPrediction($args['prediction_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
