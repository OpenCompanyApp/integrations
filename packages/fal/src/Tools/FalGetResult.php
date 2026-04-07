<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the result of a completed fal.ai request.
 *
 * Retrieves the output of a completed generation request, including
 * generated images, videos, audio, or other media artifacts.
 */
class FalGetResult implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_get_result';
    }

    public function description(): string
    {
        return 'Get the result of a completed fal.ai request. Returns generated media URLs and metadata.';
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

            $result = $this->service->getResult(
                modelId: $args['model_id'],
                requestId: $args['request_id'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
