<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MixpanelGetCurrentUser — Retrieve the authenticated user's identity.
 *
 * Calls GET /v1/me and returns the caller's Mixpanel account info,
 * useful for verifying credentials and inspecting permissions.
 */
class MixpanelGetCurrentUser implements Tool
{
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Mixpanel user. Returns account details for the API key owner — useful for verifying credentials and checking permissions.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
