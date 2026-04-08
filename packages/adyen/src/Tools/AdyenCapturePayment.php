<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to capture a previously authorized Adyen payment.
 *
 * Captures the full or partial amount of an authorized payment
 * identified by its PSP reference.
 */
class AdyenCapturePayment implements Tool
{
    /**
     * Create a new AdyenCapturePayment tool instance.
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
        return 'adyen_capture_payment';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Capture a previously authorized Adyen payment. Requires the PSP reference of the original payment and the amount to capture (value in minor units + currency). The merchant account is automatically injected.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'psp_reference' => ['type' => 'string', 'required' => true, 'description' => 'The PSP reference of the authorized payment to capture.'],
            'amount' => ['type' => 'object', 'required' => true, 'description' => 'Capture amount object with "value" (in minor units, e.g., "1000" for €10.00) and "currency" (e.g., "EUR"). Example: {"value": "1000", "currency": "EUR"}.'],
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

            $pspReference = $args['psp_reference'] ?? '';

            if (empty($pspReference)) {
                return ToolResult::error('psp_reference is required.');
            }

            if (! isset($args['amount']) || ! is_array($args['amount'])) {
                return ToolResult::error('amount is required and must be an object with "value" and "currency".');
            }

            $amount = $args['amount'];
            if (empty($amount['value']) || empty($amount['currency'])) {
                return ToolResult::error('amount must include both "value" and "currency".');
            }

            $data = [
                'amount' => $amount,
            ];

            $result = $this->service->capturePayment($pspReference, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
