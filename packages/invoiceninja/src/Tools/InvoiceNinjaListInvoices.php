<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Invoices.
 *
 * Lists invoices from Invoice Ninja with optional filtering and pagination.
 */
class InvoiceNinjaListInvoices implements Tool
{
    /**
     * Create a new InvoiceNinjaListInvoices tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_list_invoices';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List invoices from Invoice Ninja. Supports filtering by client, status, and date range with pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of invoices per page (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'client_id' => ['type' => 'string', 'description' => 'Filter invoices by client ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: draft, sent, partial, paid, cancelled, overdue, reversed.'],
            'number' => ['type' => 'string', 'description' => 'Filter by invoice number (partial match).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g. "number", "date", "due_date", "amount").'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Invoice Ninja integration is not configured.');
            }

            $params = array_filter([
                'per_page' => $args['per_page'] ?? null,
                'page' => $args['page'] ?? null,
                'client_id' => $args['client_id'] ?? null,
                'status' => $args['status'] ?? null,
                'number' => $args['number'] ?? null,
                'sort' => $args['sort'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listInvoices($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
