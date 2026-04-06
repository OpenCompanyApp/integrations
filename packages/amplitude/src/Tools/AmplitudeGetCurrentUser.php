<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeGetCurrentUser — Retrieve the authenticated user's identity.
 *
 * Calls GET /api/2/me and returns the caller's Amplitude account info,
 * useful for verifying credentials and inspecting permissions.
 */
class AmplitudeGetCurrentUser implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Amplitude user. Returns account details for the API key owner — useful for verifying credentials and checking permissions.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
