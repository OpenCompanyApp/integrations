<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRGetTimeOffRequest implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_get_time_off_request';
    }

    public function description(): string
    {
        return 'Get detailed information for a specific BambooHR time-off request by its ID.';
    }

    public function parameters(): array
    {
        return [
            'request_id' => ['type' => 'integer', 'required' => true, 'description' => 'The BambooHR time-off request ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $requestId = $args['request_id'];

            $result = $this->service->getTimeOffRequest($requestId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
