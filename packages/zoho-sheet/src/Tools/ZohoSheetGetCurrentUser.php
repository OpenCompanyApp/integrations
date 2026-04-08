<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetGetCurrentUser — Get the authenticated user's profile information.
 *
 * Returns user profile data including display name, email, and account
 * details for the currently authenticated Zoho user.
 */
class ZohoSheetGetCurrentUser implements Tool
{
    /**
     * @param  ZohoSheetService  $service  The Zoho Sheet API service instance.
     */
    public function __construct(
        private ZohoSheetService $service,
    ) {}

    /**
     * The tool identifier used by the integration framework.
     */
    public function name(): string
    {
        return 'zoho_sheet_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated Zoho Sheet user\'s profile information. Returns display name, email, and account details. Useful for verifying which account is connected.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none).
     * @return ToolResult The user profile data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Sheet integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
