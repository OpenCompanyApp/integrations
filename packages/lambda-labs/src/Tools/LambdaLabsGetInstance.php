<?php

namespace OpenCompany\Integrations\LambdaLabs\Tools;

use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LambdaLabsGetInstance implements Tool
{
    public function __construct(
        private LambdaLabsService $service,
    ) {}

    public function name(): string
    {
        return 'lambda_labs_get_instance';
    }

    public function description(): string
    {
        return 'Get details for a specific Lambda Labs GPU instance by ID. Returns full instance information including status, IP, region, and GPU type.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The instance ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lambda Labs integration is not configured.');
            }

            $result = $this->service->getInstance((string) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
