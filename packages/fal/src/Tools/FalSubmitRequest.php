<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Submit a generation request to a fal.ai model.
 *
 * Queues a request on the fal.ai platform and returns the request ID.
 * Use get_request_status to poll for completion and get_result to
 * retrieve the output once done.
 */
class FalSubmitRequest implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_submit_request';
    }

    public function description(): string
    {
        return 'Submit a generation request to a fal.ai model. Returns the request ID for tracking. Poll get_request_status for progress.';
    }

    public function parameters(): array
    {
        return [
            'model_id' => ['type' => 'string', 'required' => true, 'description' => 'The model identifier (e.g., "fal-ai/flux/schnell").'],
            'input' => ['type' => 'object', 'required' => true, 'description' => 'An object of model input values (e.g., prompt, image_url, etc.).'],
            'webhook_url' => ['type' => 'string', 'description' => 'A URL to receive POST notifications when the request completes.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('fal.ai integration is not configured.');
            }

            if (empty($args['model_id'])) {
                return ToolResult::error('model_id is required.');
            }

            if (empty($args['input']) || !is_array($args['input'])) {
                return ToolResult::error('input is required and must be an object.');
            }

            $result = $this->service->submitRequest(
                modelId: $args['model_id'],
                input: $args['input'],
                webhookUrl: $args['webhook_url'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
