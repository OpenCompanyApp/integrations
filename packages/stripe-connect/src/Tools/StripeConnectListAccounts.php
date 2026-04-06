<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe Connect accounts.
 *
 * Returns a paginated list of connected accounts with ID, business type, display name, and email.
 */
class StripeConnectListAccounts implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_list_accounts';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe Connect accounts.
        Returns a paginated list of connected accounts with ID, business type, display name, and email.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of accounts to return (1–100, default 10).'],
        ];
    }

    /**
     * List Stripe Connect accounts with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe Connect integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listAccounts($params);

            $accounts = array_map(function (array $a) {
                return [
                    'id' => $a['id'] ?? '',
                    'business_type' => $a['business_type'] ?? null,
                    'display_name' => $a['settings']['dashboard']['display_name'] ?? null,
                    'email' => $a['email'] ?? null,
                    'country' => $a['country'] ?? null,
                    'created' => $a['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'accounts' => $accounts,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
