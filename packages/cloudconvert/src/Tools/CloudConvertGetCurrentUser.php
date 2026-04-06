<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertGetCurrentUser implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated CloudConvert user profile, including remaining credits and subscription info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
