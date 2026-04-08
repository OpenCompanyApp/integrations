<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero payments with optional filtering and pagination.
 *
 * Supports filtering by status and date range.
 */
class XeroListPayments implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_payments';
    }

    public function description(): string
    {
        return <<<'MD'
        List Xero payments with optional filtering and pagination.
        Filter by status (AUTHORISED, DELETED) and date range.
        MD;
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by status: AUTHORISED, DELETED.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date filter (YYYY-MM-DD).'],
            'date_to' => ['type' => 'string', 'description' => 'End date filter (YYYY-MM-DD).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
        ];
    }

    /**
     * List Xero payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, date_from, date_to, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (! empty($args['status'])) {
                $params['Status'] = $args['status'];
            }
            if (! empty($args['date_from'])) {
                $params['FromDate'] = $args['date_from'];
            }
            if (! empty($args['date_to'])) {
                $params['ToDate'] = $args['date_to'];
            }
            if (! empty($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listPayments($params);

            $payments = array_map(function (array $p) {
                return [
                    'id' => $p['PaymentID'] ?? '',
                    'invoice_id' => $p['Invoice']['InvoiceID'] ?? '',
                    'account_id' => $p['Account']['AccountID'] ?? '',
                    'amount' => $p['Amount'] ?? 0,
                    'date' => $p['Date'] ?? '',
                    'status' => $p['Status'] ?? '',
                    'reference' => $p['Reference'] ?? '',
                ];
            }, $result['Payments'] ?? []);

            return ToolResult::success([
                'payments' => $payments,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
