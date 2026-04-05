<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current Xero user.
 *
 * Fetches the list of users and returns the first user's details.
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
        Get the current Xero user.
        Fetches the list of organisation users and returns the first user.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the first Xero user from the organisation.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $result = $this->service->listUsers();

            $users = $result['Users'] ?? [];
            if (empty($users)) {
                return ToolResult::error('No users found in the Xero organisation.');
            }

            $user = $users[0];

            return ToolResult::success([
                'id' => $user['UserID'] ?? '',
                'email' => $user['EmailAddress'] ?? '',
                'first_name' => $user['FirstName'] ?? '',
                'last_name' => $user['LastName'] ?? '',
                'name' => trim(($user['FirstName'] ?? '') . ' ' . ($user['LastName'] ?? '')),
                'role' => $user['OrganisationRole'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
