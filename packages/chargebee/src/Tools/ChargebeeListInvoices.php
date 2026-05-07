<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list invoices from Chargebee with optional filtering and pagination.
 *
 * Supports filtering by invoice status and cursor-based pagination.
 */
class ChargebeeListInvoices implements Tool
{
    /**
     * Create a new ChargebeeListInvoices tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_list_invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List invoices from Chargebee. Supports filtering by status (paid, posted, payment_due, not_paid, voided, pending) and pagination.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return per page (max 100, default 10).'],
            'page' => ['type' => 'string', 'description' => 'Pagination cursor. Pass the value from a previous response to get the next page.'],
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status: paid, posted, payment_due, not_paid, voided, pending.'],
        ];
    }

    /**
     * Execute the list invoices request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->listInvoices(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                page: $args['page'] ?? null,
                status: $args['status'] ?? null,
            );

            $invoices = $result['list'] ?? [];
            $nextOffset = $result['next_offset'] ?? null;

            $items = array_map(function (array $entry): array {
                return $entry['invoice'] ?? $entry;
            }, $invoices);

            $response = [
                'invoices' => $items,
                'count' => count($items),
            ];

            if ($nextOffset !== null) {
                $response['next_page'] = $nextOffset;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
