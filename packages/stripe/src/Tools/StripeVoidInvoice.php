<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Void a Stripe invoice.
 *
 * Marks the invoice as void. The invoice must be in "draft" or "open" status.
 */
class StripeVoidInvoice implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_void_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Void a Stripe invoice.
        Marks the invoice as void. The invoice must be in "draft" or "open" status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Invoice ID to void (e.g., "in_...").'],
        ];
    }

    /**
     * Void a Stripe invoice in "draft" or "open" status.
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

            $result = $this->service->voidInvoice($id);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'number' => $result['number'] ?? null,
                'status' => $result['status'] ?? '',
                'total' => $result['total'] ?? 0,
                'currency' => $result['currency'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
