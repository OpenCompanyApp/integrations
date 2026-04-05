<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Mollie payment.
 *
 * Requires an amount (currency + value), a description, and a redirect URL.
 * Optionally supports metadata, payment method, and locale.
 */
class MollieCreatePayment implements Tool
{
    /**
     * Create a new MollieCreatePayment tool instance.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_create_payment';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new Mollie payment. Requires amount (currency and value), description, and a redirectUrl. Returns the payment resource with a checkout link.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'object', 'required' => true, 'description' => 'Amount object with "currency" (e.g., "EUR") and "value" (e.g., "10.00").'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Description shown to the customer (e.g., "Order #123").'],
            'redirectUrl' => ['type' => 'string', 'required' => true, 'description' => 'URL to redirect the customer to after payment completion.'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata to attach to the payment.'],
            'method' => ['type' => 'string', 'description' => 'Payment method (e.g., "ideal", "creditcard", "paypal").'],
            'locale' => ['type' => 'string', 'description' => 'Locale for the payment screen (e.g., "nl_NL", "en_US").'],
        ];
    }

    /**
     * Execute the create payment tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            if (empty($args['amount'])) {
                return ToolResult::error('Amount is required. Provide an object with "currency" and "value".');
            }

            if (empty($args['description'])) {
                return ToolResult::error('Description is required.');
            }

            if (empty($args['redirectUrl'])) {
                return ToolResult::error('redirectUrl is required.');
            }

            $data = [
                'amount' => $args['amount'],
                'description' => $args['description'],
                'redirectUrl' => $args['redirectUrl'],
            ];

            if (isset($args['metadata'])) {
                $data['metadata'] = $args['metadata'];
            }
            if (isset($args['method'])) {
                $data['method'] = $args['method'];
            }
            if (isset($args['locale'])) {
                $data['locale'] = $args['locale'];
            }

            $result = $this->service->createPayment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
