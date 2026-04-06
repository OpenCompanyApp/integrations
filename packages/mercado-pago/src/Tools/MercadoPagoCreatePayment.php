<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MercadoPagoCreatePayment implements Tool
{
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_create_payment';
    }

    public function description(): string
    {
        return 'Create a new payment in Mercado Pago. Requires the transaction amount, payment method ID, and payer email. Optionally specify the number of installments.';
    }

    public function parameters(): array
    {
        return [
            'transaction_amount' => ['type' => 'number', 'required' => true, 'description' => 'The amount to charge (positive number, e.g., 100.50).'],
            'payment_method_id' => ['type' => 'string', 'required' => true, 'description' => 'The payment method ID (e.g., "visa", "master", "pix", "boleto", "amex").'],
            'payer_email' => ['type' => 'string', 'required' => true, 'description' => 'The payer\'s email address.'],
            'installments' => ['type' => 'integer', 'description' => 'Number of installments for credit card payments (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mercado Pago integration is not configured.');
            }

            $data = [
                'transaction_amount' => (float) $args['transaction_amount'],
                'payment_method_id' => $args['payment_method_id'],
                'payer' => [
                    'email' => $args['payer_email'],
                ],
            ];

            if (isset($args['installments'])) {
                $data['installments'] = (int) $args['installments'];
            }

            $result = $this->service->createPayment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
