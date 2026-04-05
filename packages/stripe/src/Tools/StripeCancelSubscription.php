<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a Stripe subscription by ID.
 *
 * Supports proration and immediate invoicing options.
 */
class StripeCancelSubscription implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_cancel_subscription';
    }

    public function description(): string
    {
        return <<<'MD'
        Cancel a Stripe subscription by ID.
        Supports proration and immediate invoicing options.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID to cancel (e.g., "sub_...").'],
            'prorate' => ['type' => 'boolean', 'description' => 'Whether to prorate unused time. Default: true.'],
            'invoice_now' => ['type' => 'boolean', 'description' => 'Whether to generate a final invoice immediately. Default: true.'],
        ];
    }

    /**
     * Cancel a Stripe subscription by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, prorate, invoice_now)
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

            $params = [];

            if (isset($args['prorate'])) {
                $params['prorate'] = $args['prorate'] ? 'true' : 'false';
            }
            if (isset($args['invoice_now'])) {
                $params['invoice_now'] = $args['invoice_now'] ? 'true' : 'false';
            }

            $result = $this->service->cancelSubscription($id, $params);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'customer' => $result['customer'] ?? '',
                'status' => $result['status'] ?? '',
                'canceled_at' => $result['canceled_at'] ?? null,
                'ended_at' => $result['ended_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
