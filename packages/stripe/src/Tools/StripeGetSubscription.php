<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe subscription by ID.
 *
 * Returns full subscription details including status, plan, billing cycle, and trial info.
 */
class StripeGetSubscription implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_subscription';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe subscription by ID.
        Returns full subscription details including status, plan, billing cycle, and trial info.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID (e.g., "sub_...").'],
        ];
    }

    /**
     * Retrieve a Stripe subscription by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $sub = $this->service->getSubscription($id);

            return ToolResult::success([
                'id' => $sub['id'] ?? '',
                'customer' => $sub['customer'] ?? '',
                'status' => $sub['status'] ?? '',
                'plan' => $sub['plan'] ?? null,
                'trial_start' => $sub['trial_start'] ?? null,
                'trial_end' => $sub['trial_end'] ?? null,
                'current_period_start' => $sub['current_period_start'] ?? null,
                'current_period_end' => $sub['current_period_end'] ?? null,
                'canceled_at' => $sub['canceled_at'] ?? null,
                'ended_at' => $sub['ended_at'] ?? null,
                'metadata' => $sub['metadata'] ?? [],
                'created' => $sub['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
