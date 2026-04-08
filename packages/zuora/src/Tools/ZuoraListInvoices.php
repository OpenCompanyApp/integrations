<?php

namespace OpenCompany\Integrations\Zuora\Tools;

use OpenCompany\Integrations\Zuora\ZuoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zuora invoices.
 *
 * Retrieves a paginated list of invoices from the Zuora tenant.
 * Supports filtering by account ID, invoice number, status, and date range.
 */
class ZuoraListInvoices implements Tool
{
    /**
     * Create a new ZuoraListInvoices tool instance.
     */
    public function __construct(
        private ZuoraService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zuora_list_invoices';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'List Zuora invoices. Returns invoice IDs, numbers, amounts, status, and dates. Supports filtering by account, status, and date.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to get the next page.'],
            'filter' => ['type' => 'string', 'description' => 'Filter expression, e.g. "status.EQ:Posted" or "account_id.EQ:8a90b89a...".'],
        ];
    }

    /**
     * Execute the tool — list Zuora invoices.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing invoice data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zuora integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 20;
            $cursor = $args['cursor'] ?? null;

            $filters = [];
            if (isset($args['filter'])) {
                $filters['filter'] = $args['filter'];
            }

            $result = $this->service->listInvoices($pageSize, $cursor, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
