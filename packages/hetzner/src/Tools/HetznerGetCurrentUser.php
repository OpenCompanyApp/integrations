<?php

namespace OpenCompany\Integrations\Hetzner\Tools;

use OpenCompany\Integrations\Hetzner\HetznerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Hetzner Cloud user profile.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class HetznerGetCurrentUser implements Tool
{
    public function __construct(
        private HetznerService $service,
    ) {}

    public function name(): string
    {
        return 'hetzner_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Hetzner Cloud user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hetzner Cloud integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
