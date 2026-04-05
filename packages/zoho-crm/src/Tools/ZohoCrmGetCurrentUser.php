<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Zoho CRM user.
 *
 * Returns the current user's profile information.
 */
class ZohoCrmGetCurrentUser implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Zoho CRM user.
        Returns the user's profile information including name, email, role, and other details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current Zoho CRM user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $users = $result['users'] ?? [];
            $user = $users[0] ?? [];

            return ToolResult::success([
                'user' => $user,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
