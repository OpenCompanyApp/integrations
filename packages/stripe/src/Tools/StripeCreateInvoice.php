<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Stripe invoice for a customer.
 *
 * Requires a customer ID. Supports description, subscription, metadata, and auto_advance.
 */
class StripeCreateInvoice implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_invoice';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Stripe invoice for a customer.
        Requires a customer ID. Supports description, subscription, metadata, and auto_advance.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer' => ['type' => 'string', 'required' => true, 'description' => 'Stripe customer ID (e.g., "cus_...").'],
            'description' => ['type' => 'string', 'description' => 'Invoice description.'],
            'subscription' => ['type' => 'string', 'description' => 'Subscription ID to invoice for.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
            'auto_advance' => ['type' => 'boolean', 'description' => 'Automatically finalize the invoice. Default: true.'],
        ];
    }

    /**
     * Create a Stripe invoice for a customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer, description, subscription, metadata, auto_advance)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $customer = $args['customer'] ?? '';
            if (empty($customer)) {
                return ToolResult::error('customer is required.');
            }

            $data = ['customer' => $customer];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['subscription'])) {
                $data['subscription'] = $args['subscription'];
            }
            if (isset($args['auto_advance'])) {
                $data['auto_advance'] = $args['auto_advance'] ? 'true' : 'false';
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->createInvoice($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'number' => $result['number'] ?? null,
                'customer' => $result['customer'] ?? '',
                'status' => $result['status'] ?? '',
                'total' => $result['total'] ?? 0,
                'currency' => $result['currency'] ?? '',
                'due_date' => $result['due_date'] ?? null,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
