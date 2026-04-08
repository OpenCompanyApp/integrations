<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Replicate prediction.
 *
 * Submits input to a model version and returns the prediction object.
 * Predictions may start in a "starting" or "processing" state — poll
 * get_prediction to check for completion. Optionally provide a webhook
 * URL for async notifications.
 */
class ReplicateCreatePrediction implements Tool
{
    public function __construct(
        private ReplicateService $service,
    ) {}

    public function name(): string
    {
        return 'replicate_create_prediction';
    }

    public function description(): string
    {
        return 'Create a new prediction on Replicate by providing a model version and input. Returns the prediction object with status. Poll get_prediction for results.';
    }

    public function parameters(): array
    {
        return [
            'version' => ['type' => 'string', 'required' => true, 'description' => 'The model version ID (a hex string).'],
            'input' => ['type' => 'object', 'required' => true, 'description' => 'An object of model input values (varies by model).'],
            'webhook' => ['type' => 'string', 'description' => 'A URL to receive POST notifications when the prediction completes.'],
            'webhook_events' => ['type' => 'array', 'description' => 'List of webhook events to subscribe to (e.g., ["output", "completed"]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
            }

            if (empty($args['version'])) {
                return ToolResult::error('version is required.');
            }

            if (empty($args['input']) || !is_array($args['input'])) {
                return ToolResult::error('input is required and must be an object.');
            }

            $result = $this->service->createPrediction(
                modelVersion: $args['version'],
                input: $args['input'],
                webhook: $args['webhook'] ?? null,
                webhookEvents: $args['webhook_events'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
