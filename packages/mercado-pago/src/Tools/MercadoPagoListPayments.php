<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Mercado Pago payments.
 *
 * Supports pagination, status, external reference, sort order, and the
 * official range, begin_date, and end_date query parameters.
 */
class MercadoPagoListPayments implements Tool
{
    /**
     * @param  MercadoPagoService  $service  The Mercado Pago API service.
     */
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_list_payments';
    }

    public function description(): string
    {
        return 'Search and list payments from Mercado Pago. Supports filtering by status, external reference, and date range. Returns a paginated list of payment records.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 30, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
            'external_reference' => ['type' => 'string', 'description' => 'Filter by the external reference you set when creating the payment.'],
            'status' => ['type' => 'string', 'description' => 'Filter by payment status: pending, approved, authorized, in_process, in_mediation, rejected, cancelled, refunded, charged_back.'],
            'date_created_from' => ['type' => 'string', 'description' => 'Filter payments created after this date (ISO 8601, e.g., "2025-01-01T00:00:00.000-00:00").'],
            'date_created_to' => ['type' => 'string', 'description' => 'Filter payments created before this date (ISO 8601, e.g., "2025-12-31T23:59:59.999-00:00").'],
            'sort' => ['type' => 'string', 'description' => 'Sort field such as date_created, date_approved, date_last_updated, id, or money_release_date.'],
            'criteria' => ['type' => 'string', 'description' => 'Sort direction: asc or desc.'],
        ];
    }

    /**
     * Execute the payment search request.
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

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['external_reference'])) {
                $params['external_reference'] = $args['external_reference'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['date_created_from'])) {
                $params['range'] = 'date_created';
                $params['begin_date'] = $args['date_created_from'];
            }
            if (isset($args['date_created_to'])) {
                $params['range'] = 'date_created';
                $params['end_date'] = $args['date_created_to'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['criteria'])) {
                $params['criteria'] = $args['criteria'];
            }

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
