<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MercadoPagoGetPayment implements Tool
{
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_get_payment';
    }

    public function description(): string
    {
        return 'Retrieve full details of a specific Mercado Pago payment by its ID. Returns payment status, amount, payer information, and more.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Mercado Pago payment ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mercado Pago integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Payment ID is required.');
            }

            $result = $this->service->getPayment($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
