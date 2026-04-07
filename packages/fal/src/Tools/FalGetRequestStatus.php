<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the status of a submitted fal.ai request.
 *
 * Returns the current status of a queued or processing request.
 * Possible statuses include IN_QUEUE, IN_PROGRESS, and COMPLETED.
 */
class FalGetRequestStatus implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_get_request_status';
    }

    public function description(): string
    {
        return 'Get the status of a submitted fal.ai request. Returns queue position and processing state.';
    }

    public function parameters(): array
    {
        return [
            'model_id' => ['type' => 'string', 'required' => true, 'description' => 'The model identifier used when submitting the request.'],
            'request_id' => ['type' => 'string', 'required' => true, 'description' => 'The request ID returned by submit_request.'],
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

            if (empty($args['request_id'])) {
                return ToolResult::error('request_id is required.');
            }

            $result = $this->service->getRequestStatus(
                modelId: $args['model_id'],
                requestId: $args['request_id'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
