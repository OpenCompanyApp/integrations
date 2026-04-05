<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the current user's account information from Zoho Mail.
 *
 * Returns account details including account IDs needed for other
 * tool operations, email addresses, and display names.
 *
 * @see https://www.zoho.com/mail/help/api/getaccounts.html
 */
class ZohoMailGetCurrentUser implements Tool
{
    /**
     * Create a new ZohoMailGetCurrentUser tool instance.
     *
     * @param ZohoMailService $service The Zoho Mail service for API communication
     */
    public function __construct(
        private ZohoMailService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zohomail_get_current_user';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get the current user\'s Zoho Mail account information. Returns account IDs needed for other Zoho Mail operations.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param array<string, mixed> $args Tool arguments (unused)
     *
     * @return ToolResult The result containing account info or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
