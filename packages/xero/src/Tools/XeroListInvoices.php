<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero invoices with pagination and filtering.
 *
 * Returns a paginated list of invoices with their IDs, numbers, amounts, and status.
 */
class XeroListInvoices implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_invoices';
    }

    public function description(): string
    {
        return <<<'MD'
        List Xero invoices with pagination and filtering.
        Returns invoice IDs, numbers, amounts, status, and dates.
        Use page and pageSize for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of invoices per page (default 100, max 2000).'],
            'statuses' => ['type' => 'string', 'description' => 'Comma-separated filter: DRAFT, SUBMITTED, AUTHORISED, PAID, VOIDED, DELETED.'],
            'where' => ['type' => 'string', 'description' => 'Xero where filter expression (e.g. Type=="ACCREC").'],
            'order' => ['type' => 'string', 'description' => 'Sort order (e.g. "Date DESC", "InvoiceNumber ASC").'],
        ];
    }

    /**
     * List Xero invoices with optional pagination and filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, pageSize, statuses, where, order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }
            if (! empty($args['statuses'])) {
                $params['Statuses'] = $args['statuses'];
            }
            if (! empty($args['where'])) {
                $params['where'] = $args['where'];
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listInvoices($params);

            $invoices = array_map(function (array $inv): array {
                return [
                    'id' => $inv['InvoiceID'] ?? '',
                    'number' => $inv['InvoiceNumber'] ?? '',
                    'type' => $inv['Type'] ?? '',
                    'status' => $inv['Status'] ?? '',
                    'date' => $inv['Date'] ?? '',
                    'due_date' => $inv['DueDate'] ?? '',
                    'total' => $inv['Total'] ?? 0,
                    'amount_due' => $inv['AmountDue'] ?? 0,
                    'amount_paid' => $inv['AmountPaid'] ?? 0,
                    'currency' => $inv['CurrencyCode'] ?? '',
                    'contact' => isset($inv['Contact']) ? [
                        'id' => $inv['Contact']['ContactID'] ?? '',
                        'name' => $inv['Contact']['Name'] ?? '',
                    ] : [],
                ];
            }, $result['Invoices'] ?? []);

            return ToolResult::success([
                'results' => $invoices,
                'count' => count($invoices),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
