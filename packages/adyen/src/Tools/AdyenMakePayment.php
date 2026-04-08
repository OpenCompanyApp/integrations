<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to initiate a payment through the Adyen Checkout API.
 *
 * Creates a new payment with the specified amount, currency, and
 * payment method. The merchant account is auto-injected from the
 * integration configuration.
 */
class AdyenMakePayment implements Tool
{
    /**
     * Create a new AdyenMakePayment tool instance.
     *
     * @param  \OpenCompany\Integrations\Adyen\AdyenService  $service
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_make_payment';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Initiate a payment through Adyen. Requires amount (value in minor units + currency) and payment method. The merchant account is automatically injected from the integration configuration. Returns the payment result including PSP reference.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'amount' => ['type' => 'object', 'required' => true, 'description' => 'Payment amount object with "value" (in minor units, e.g., "1000" for €10.00) and "currency" (e.g., "EUR", "USD"). Example: {"value": "1000", "currency": "EUR"}.'],
            'payment_method' => ['type' => 'object', 'required' => true, 'description' => 'Payment method details. For example: {"type": "scheme", "encryptedCardNumber": "...", "encryptedExpiryMonth": "...", "encryptedExpiryYear": "...", "encryptedSecurityCode": "..."}.'],
            'reference' => ['type' => 'string', 'description' => 'A custom reference for this payment (e.g., an order number).'],
            'return_url' => ['type' => 'string', 'description' => 'URL to redirect the shopper back to after payment completion.'],
            'shopper_reference' => ['type' => 'string', 'description' => 'Unique identifier for the shopper (for recurring payments).'],
            'shopper_email' => ['type' => 'string', 'description' => 'Shopper email address.'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Adyen integration is not configured.');
            }

            if (! isset($args['amount']) || ! is_array($args['amount'])) {
                return ToolResult::error('amount is required and must be an object with "value" and "currency".');
            }

            $amount = $args['amount'];
            if (empty($amount['value']) || empty($amount['currency'])) {
                return ToolResult::error('amount must include both "value" and "currency".');
            }

            if (! isset($args['payment_method']) || ! is_array($args['payment_method'])) {
                return ToolResult::error('payment_method is required and must be an object.');
            }

            $data = [
                'amount' => $amount,
                'paymentMethod' => $args['payment_method'],
            ];

            if (isset($args['reference'])) {
                $data['reference'] = $args['reference'];
            }

            if (isset($args['return_url'])) {
                $data['returnUrl'] = $args['return_url'];
            }

            if (isset($args['shopper_reference'])) {
                $data['shopperReference'] = $args['shopper_reference'];
            }

            if (isset($args['shopper_email'])) {
                $data['shopperEmail'] = $args['shopper_email'];
            }

            $result = $this->service->makePayment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
