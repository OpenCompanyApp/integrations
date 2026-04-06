<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Stripe Connect user.
 *
 * Returns user profile information including ID, name, and email.
 */
class StripeConnectGetCurrentUser implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Stripe Connect user.
        Returns user profile information including ID, name, and email.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated Stripe Connect user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe Connect integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'name' => $user['name'] ?? null,
                'email' => $user['email'] ?? null,
                'created' => $user['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
