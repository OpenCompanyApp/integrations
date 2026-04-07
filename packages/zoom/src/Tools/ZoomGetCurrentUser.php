<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Zoom user profile.
 *
 * Returns the user object including id, email, first_name, last_name,
 * type, status, timezone, and created_at.
 */
class ZoomGetCurrentUser implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Zoom user. Returns email, name, account type, status, and timezone.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
