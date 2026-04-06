<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryGetCurrentUser implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Sentry user. Returns user name, email, and organization memberships. Useful for verifying the connection and identifying which Sentry account is being used.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sentry integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
