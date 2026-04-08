<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new PayPal checkout order.
 *
 * Creates an order with the specified intent (CAPTURE or AUTHORIZE),
 * purchase units, and optional payment source configuration.
 */
class PayPalCreateOrder implements Tool
{
    /**
     * Create a new PayPalCreateOrder tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_create_order';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Create a new PayPal checkout order. Specify the intent, purchase units with amounts, and optional payer details. Returns the created order with approval links.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'intent' => ['type' => 'string', 'required' => true, 'description' => 'The order intent: "CAPTURE" to capture funds immediately, or "AUTHORIZE" to authorize and capture later.'],
            'purchase_units' => ['type' => 'array', 'required' => true, 'description' => 'Array of purchase units. Each unit must have an "amount" object with "currency_code" and "value". May include "description", "items", and "shipping".'],
            'payer' => ['type' => 'array', 'description' => 'Payer information: name, email_address, address, phone.'],
            'payment_source' => ['type' => 'array', 'description' => 'Payment source configuration (e.g., paypal, card).'],
        ];
    }

    /**
     * Execute the create order request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            if (empty($args['intent'])) {
                return ToolResult::error('intent is required (CAPTURE or AUTHORIZE).');
            }

            if (empty($args['purchase_units'])) {
                return ToolResult::error('purchase_units is required.');
            }

            $body = [
                'intent' => strtoupper($args['intent']),
                'purchase_units' => $args['purchase_units'],
            ];

            if (isset($args['payer'])) {
                $body['payer'] = $args['payer'];
            }

            if (isset($args['payment_source'])) {
                $body['payment_source'] = $args['payment_source'];
            }

            $result = $this->service->createOrder($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
