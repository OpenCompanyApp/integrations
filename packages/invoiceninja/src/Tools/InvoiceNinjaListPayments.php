<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Payments.
 *
 * Lists payments from Invoice Ninja with optional filtering and pagination.
 */
class InvoiceNinjaListPayments implements Tool
{
    /**
     * Create a new InvoiceNinjaListPayments tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_list_payments';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List payments from Invoice Ninja. Supports filtering by client, invoice, status, and date range with pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of payments per page (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'client_id' => ['type' => 'string', 'description' => 'Filter payments by client ID.'],
            'invoice_id' => ['type' => 'string', 'description' => 'Filter payments by invoice ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by payment status (e.g. "completed", "pending", "failed", "refunded").'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g. "amount", "date", "created_at").'],
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
                'invoice_id' => $args['invoice_id'] ?? null,
                'status' => $args['status'] ?? null,
                'sort' => $args['sort'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
