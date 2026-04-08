<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MercadoPagoGetCustomer implements Tool
{
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_get_customer';
    }

    public function description(): string
    {
        return 'Retrieve full details of a specific Mercado Pago customer by their ID. Returns customer name, email, default card, and more.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Mercado Pago customer ID.'],
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
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
