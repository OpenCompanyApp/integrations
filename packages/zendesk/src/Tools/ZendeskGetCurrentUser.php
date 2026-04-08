<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Zendesk user.
 *
 * Returns the user's ID, name, email, role, and avatar for the authenticated token.
 */
class ZendeskGetCurrentUser implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated Zendesk user.
        Returns the user's ID, name, email, role, and avatar.
        Useful for identifying which account or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated Zendesk user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $result = $this->service->getMe();

            $user = $result['user'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'name' => $user['name'] ?? '',
                'email' => $user['email'] ?? '',
                'role' => $user['role'] ?? '',
                'avatar' => $user['photo'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
