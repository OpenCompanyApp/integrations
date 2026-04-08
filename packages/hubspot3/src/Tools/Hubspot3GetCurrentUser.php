<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated HubSpot user.
 *
 * Returns the user's ID, email, and profile information.
 */
class Hubspot3GetCurrentUser implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated HubSpot user's information.
        Returns the user's ID, email, name, and portal information.
        Useful for identifying which account or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated HubSpot user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $result = $this->service->getMe();

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
