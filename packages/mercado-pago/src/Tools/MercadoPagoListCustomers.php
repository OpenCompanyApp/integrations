<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Mercado Pago customers.
 *
 * Supports email filtering plus limit and offset pagination.
 */
class MercadoPagoListCustomers implements Tool
{
    /**
     * @param  MercadoPagoService  $service  The Mercado Pago API service.
     */
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_list_customers';
    }

    public function description(): string
    {
        return 'Search and list customers in Mercado Pago. Optionally filter by email. Returns a paginated list of customer records.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Filter customers by email address.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the customer search request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mercado Pago integration is not configured.');
            }

            $params = [];

            if (isset($args['email'])) {
                $params['email'] = $args['email'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
