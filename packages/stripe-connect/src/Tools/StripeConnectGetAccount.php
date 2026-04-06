<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe Connect account by ID.
 *
 * Returns full account details including business profile, capabilities, and metadata.
 */
class StripeConnectGetAccount implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_get_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe Connect account by ID.
        Returns full account details including business profile, capabilities, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe Connect account ID (e.g., "acct_...").'],
        ];
    }

    /**
     * Retrieve a Stripe Connect account by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe Connect integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $account = $this->service->getAccount($id);

            return ToolResult::success([
                'id' => $account['id'] ?? '',
                'business_type' => $account['business_type'] ?? null,
                'display_name' => $account['settings']['dashboard']['display_name'] ?? null,
                'email' => $account['email'] ?? null,
                'country' => $account['country'] ?? null,
                'default_currency' => $account['default_currency'] ?? null,
                'capabilities' => $account['capabilities'] ?? [],
                'metadata' => $account['metadata'] ?? [],
                'charges_enabled' => $account['charges_enabled'] ?? false,
                'payouts_enabled' => $account['payouts_enabled'] ?? false,
                'created' => $account['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
