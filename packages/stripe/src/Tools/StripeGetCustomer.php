<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Stripe customer by ID.
 *
 * Returns full customer details including email, name, metadata, and default payment method.
 */
class StripeGetCustomer implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_get_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Stripe customer by ID.
        Returns full customer details including email, name, metadata, and default payment method.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe customer ID (e.g., "cus_...").'],
        ];
    }

    /**
     * Retrieve a Stripe customer by ID with full details.
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

            $customer = $this->service->getCustomer($id);

            return ToolResult::success([
                'id' => $customer['id'] ?? '',
                'name' => $customer['name'] ?? '',
                'email' => $customer['email'] ?? '',
                'phone' => $customer['phone'] ?? null,
                'description' => $customer['description'] ?? null,
                'metadata' => $customer['metadata'] ?? [],
                'default_payment_method' => $customer['invoice_settings']['default_payment_method'] ?? null,
                'created' => $customer['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
