<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Venmo user.
 *
 * Returns the authenticated user's full profile including balance and account details.
 */
class VenmoGetCurrentUser implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Venmo user.
        Returns the authenticated user's full profile including balance and account details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the currently authenticated Venmo user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $user = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'username' => $user['username'] ?? '',
                'display_name' => $user['display_name'] ?? '',
                'first_name' => $user['first_name'] ?? null,
                'last_name' => $user['last_name'] ?? null,
                'email' => $user['email'] ?? null,
                'phone' => $user['phone'] ?? null,
                'profile_picture_url' => $user['profile_picture_url'] ?? null,
                'about' => $user['about'] ?? null,
                'date_joined' => $user['date_joined'] ?? null,
                'balance' => $user['balance'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
