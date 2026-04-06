<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertGetTask implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_get_task';
    }

    public function description(): string
    {
        return 'Get details and status of a CloudConvert task by ID, including the result payload with download URLs for completed conversions.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The CloudConvert task ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $result = $this->service->getTask($args['task_id']);
            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
