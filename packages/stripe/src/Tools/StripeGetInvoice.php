<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe invoice by ID.
 *
 * Returns full invoice details including line items, totals, and status.
 */
class StripeGetInvoice implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe invoice by ID.
        Returns full invoice details including line items, totals, and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Invoice ID (e.g., "in_...").'],
        ];
    }

    /**
     * Retrieve a Stripe invoice by ID with full details.
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

            $invoice = $this->service->getInvoice($id);

            return ToolResult::success([
                'id' => $invoice['id'] ?? '',
                'number' => $invoice['number'] ?? null,
                'customer' => $invoice['customer'] ?? '',
                'status' => $invoice['status'] ?? '',
                'subtotal' => $invoice['subtotal'] ?? 0,
                'total' => $invoice['total'] ?? 0,
                'tax' => $invoice['tax'] ?? null,
                'currency' => $invoice['currency'] ?? '',
                'description' => $invoice['description'] ?? null,
                'due_date' => $invoice['due_date'] ?? null,
                'paid' => $invoice['paid'] ?? false,
                'attempt_count' => $invoice['attempt_count'] ?? 0,
                'metadata' => $invoice['metadata'] ?? [],
                'created' => $invoice['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
