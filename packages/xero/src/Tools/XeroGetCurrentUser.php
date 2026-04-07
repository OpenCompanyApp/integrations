<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Xero user.
 *
 * Returns the user's ID, name, and email for the authenticated token.
 */
class XeroGetCurrentUser implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated Xero user.
        Returns the user's ID, name, and email.
        Useful for identifying which Xero organisation or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated Xero user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $users = $result['Users'] ?? [];
            $user = $users[0] ?? $result;

            return ToolResult::success([
                'id' => $user['UserID'] ?? '',
                'first_name' => $user['FirstName'] ?? '',
                'last_name' => $user['LastName'] ?? '',
                'email' => $user['EmailAddress'] ?? '',
                'name' => trim(($user['FirstName'] ?? '') . ' ' . ($user['LastName'] ?? '')),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
