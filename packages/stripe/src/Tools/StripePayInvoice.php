<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Pay a Stripe invoice.
 *
 * The invoice must be in "open" status and the customer must have a payment method.
 */
class StripePayInvoice implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_pay_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Pay a Stripe invoice.
        The invoice must be in "open" status and the customer must have a payment method.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Invoice ID to pay (e.g., "in_...").'],
        ];
    }

    /**
     * Pay a Stripe invoice that is in "open" status.
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

            $result = $this->service->payInvoice($id);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'number' => $result['number'] ?? null,
                'status' => $result['status'] ?? '',
                'paid' => $result['paid'] ?? false,
                'total' => $result['total'] ?? 0,
                'currency' => $result['currency'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
