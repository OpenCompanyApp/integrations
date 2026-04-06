<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapGetCurrentUser implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current Mailtrap user profile and account info. Useful as a health check.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
