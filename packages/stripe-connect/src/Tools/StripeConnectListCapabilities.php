<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe Connect account capabilities.
 *
 * Returns capabilities for a specified connected account, including activation status.
 */
class StripeConnectListCapabilities implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_list_capabilities';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe Connect account capabilities.
        Returns capabilities for a specified connected account, including activation status (active, inactive, pending).
        MD;
    }

    public function parameters(): array
    {
        return [
            'account' => ['type' => 'string', 'required' => true, 'description' => 'Stripe Connect account ID (e.g., "acct_...").'],
        ];
    }

    /**
     * List Stripe Connect account capabilities.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe Connect integration is not configured.');
            }

            $account = $args['account'] ?? '';
            if (empty($account)) {
                return ToolResult::error('account is required.');
            }

            $result = $this->service->listCapabilities(['account' => $account]);

            $capabilities = array_map(function (array $c) {
                return [
                    'id' => $c['id'] ?? '',
                    'account' => $c['account'] ?? '',
                    'status' => $c['status'] ?? '',
                    'requested' => $c['requested'] ?? false,
                    'requested_at' => $c['requested_at'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'capabilities' => $capabilities,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
