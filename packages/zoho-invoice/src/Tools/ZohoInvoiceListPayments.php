<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * List payments received in Zoho Invoice.
 */
class ZohoInvoiceListPayments implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_list_payments';
    }

    public function description(): string
    {
        return 'List payments received in Zoho Invoice. Supports filtering by customer, date range, and payment mode.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => [
                'type' => 'string',
                'description' => 'Filter payments for a specific customer by their contact ID.',
            ],
            'date_start' => [
                'type' => 'string',
                'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01").',
            ],
            'date_end' => [
                'type' => 'string',
                'description' => 'End date for filtering (ISO 8601, e.g., "2025-12-31").',
            ],
            'payment_mode' => [
                'type' => 'string',
                'description' => 'Filter by payment mode: cash, check, bank_transfer, credit_card, etc.',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'per_page' => [
                'type' => 'integer',
                'description' => 'Number of payments per page (default: 25, max: 200).',
            ],
        ];
    }

    /**
     * Execute the list payments tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $params = [];

            if (isset($args['customer_id'])) {
                $params['customer_id'] = $args['customer_id'];
            }
            if (isset($args['date_start'])) {
                $params['date_start'] = $args['date_start'];
            }
            if (isset($args['date_end'])) {
                $params['date_end'] = $args['date_end'];
            }
            if (isset($args['payment_mode'])) {
                $params['payment_mode'] = $args['payment_mode'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
