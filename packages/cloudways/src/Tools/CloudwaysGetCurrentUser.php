<?php

namespace OpenCompany\Integrations\Cloudways\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cloudways\CloudwaysService;

class CloudwaysGetCurrentUser implements Tool
{
    public function __construct(private CloudwaysService $service) {}

    public function name(): string
    {
        return 'cloudways_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Cloudways account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudways integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
