<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestGetCurrentUser implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Pinterest user\'s account information, including username, profile image, and account type.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
