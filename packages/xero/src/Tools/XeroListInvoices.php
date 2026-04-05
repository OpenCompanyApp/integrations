<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero invoices with optional filtering and pagination.
 *
 * Supports filtering by status, contact, date range, and ordering.
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
        List Xero invoices with optional filtering and pagination.
        Filter by status (DRAFT, SUBMITTED, AUTHORISED, PAID, VOIDED), contact, date range.
        MD;
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by status: DRAFT, SUBMITTED, AUTHORISED, PAID, VOIDED.'],
            'contact_id' => ['type' => 'string', 'description' => 'Filter by Xero contact GUID.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date filter (YYYY-MM-DD).'],
            'date_to' => ['type' => 'string', 'description' => 'End date filter (YYYY-MM-DD).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
            'order' => ['type' => 'string', 'description' => 'Sort order, e.g. "Date ASC" or "Date DESC".'],
        ];
    }

    /**
     * List Xero invoices with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, contact_id, date_from, date_to, page, order)
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
            if (! empty($args['contact_id'])) {
                $params['ContactID'] = $args['contact_id'];
            }
            if (! empty($args['date_from'])) {
                $params['DateFrom'] = $args['date_from'];
            }
            if (! empty($args['date_to'])) {
                $params['DateTo'] = $args['date_to'];
            }
            if (! empty($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listInvoices($params);

            $invoices = array_map(function (array $inv) {
                return [
                    'id' => $inv['InvoiceID'] ?? '',
                    'number' => $inv['InvoiceNumber'] ?? '',
                    'type' => $inv['Type'] ?? '',
                    'status' => $inv['Status'] ?? '',
                    'contact' => $inv['Contact']['Name'] ?? '',
                    'date' => $inv['Date'] ?? '',
                    'due_date' => $inv['DueDate'] ?? '',
                    'total' => $inv['Total'] ?? 0,
                    'currency' => $inv['CurrencyCode'] ?? '',
                ];
            }, $result['Invoices'] ?? []);

            return ToolResult::success([
                'invoices' => $invoices,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
