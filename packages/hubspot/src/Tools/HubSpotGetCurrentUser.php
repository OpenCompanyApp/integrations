<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HubSpot\HubSpotService;

/**
 * Retrieve the currently authenticated HubSpot user and portal.
 *
 * Useful for confirming which account a stored token belongs to.
 */
class HubSpotGetCurrentUser implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated HubSpot user, email, and portal information for the stored token.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the authenticated HubSpot user and portal information.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['user_id'] ?? $result['id'] ?? '',
                'email' => $result['user'] ?? $result['email'] ?? '',
                'first_name' => $result['first_name'] ?? '',
                'last_name' => $result['last_name'] ?? '',
                'portal_id' => $result['portal_id'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
