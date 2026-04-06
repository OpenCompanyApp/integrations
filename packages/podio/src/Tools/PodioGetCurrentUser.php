<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's status.
 *
 * Returns user profile, active orgs, and session information.
 */
class PodioGetCurrentUser implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_get_current_user';
    }

    public function description(): string
    {
        return 'Get the status of the currently authenticated Podio user, including profile information, active organization memberships, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $status = $this->service->getCurrentUser();

            return ToolResult::success($status);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
