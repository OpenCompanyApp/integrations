<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebexGetCurrentUser implements Tool
{
    public function __construct(
        private WebexService $service,
    ) {}

    public function name(): string
    {
        return 'webex_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Webex user. Returns display name, email, avatar, and account details. Useful for identifying which account the integration is connected to.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webex integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
