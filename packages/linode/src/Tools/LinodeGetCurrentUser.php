<?php

namespace OpenCompany\Integrations\Linode\Tools;

use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the authenticated Linode user profile.
 */
class LinodeGetCurrentUser implements Tool
{
    /**
     * @param  LinodeService  $service  The Linode API client.
     */
    public function __construct(
        private LinodeService $service,
    ) {}

    public function name(): string
    {
        return 'linode_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Linode user, including username, email, and account status.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the current Linode profile details.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Linode integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
