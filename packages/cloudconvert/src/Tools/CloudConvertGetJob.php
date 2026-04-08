<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertGetJob implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_get_job';
    }

    public function description(): string
    {
        return 'Get details and status of a CloudConvert job by ID, including all associated tasks and their results.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'required' => true, 'description' => 'The CloudConvert job ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $result = $this->service->getJob($args['job_id']);
            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
