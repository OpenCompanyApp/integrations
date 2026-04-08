<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneGetCurrentUser implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Kintone user, including name, email, and user settings.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
