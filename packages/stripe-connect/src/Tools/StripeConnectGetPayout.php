<?php

namespace OpenCompany\Integrations\StripeConnect\Tools;

use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe Connect payout by ID.
 *
 * Returns full payout details including amount, status, arrival date, and destination.
 */
class StripeConnectGetPayout implements Tool
{
    /**
     * @param  StripeConnectService  $service  The Stripe Connect API client
     */
    public function __construct(
        private StripeConnectService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_connect_get_payout';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe Connect payout by ID.
        Returns full payout details including amount, status, arrival date, and destination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe payout ID (e.g., "po_...").'],
        ];
    }

    /**
     * Retrieve a Stripe Connect payout by ID with full details.
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

            $payout = $this->service->getPayout($id);

            return ToolResult::success([
                'id' => $payout['id'] ?? '',
                'amount' => $payout['amount'] ?? 0,
                'currency' => $payout['currency'] ?? '',
                'status' => $payout['status'] ?? '',
                'arrival_date' => $payout['arrival_date'] ?? null,
                'method' => $payout['method'] ?? null,
                'destination' => $payout['destination'] ?? null,
                'failure_code' => $payout['failure_code'] ?? null,
                'failure_message' => $payout['failure_message'] ?? null,
                'metadata' => $payout['metadata'] ?? [],
                'statement_descriptor' => $payout['statement_descriptor'] ?? null,
                'created' => $payout['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
