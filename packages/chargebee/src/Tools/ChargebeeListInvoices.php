<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list invoices from Chargebee with optional filtering.
 *
 * Supports pagination and filtering by status and date range.
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
        return 'List invoices from Chargebee. Supports filtering by status (paid, posted, payment_due, not_paid, voided, pending) and date range.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return per page (max 100, default 10).'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset — pass the value from a previous response to get the next page.'],
            'status' => ['type' => 'string', 'description' => 'Filter by invoice status: paid, posted, payment_due, not_paid, voided, pending.'],
            'date_after' => ['type' => 'string', 'description' => 'Filter invoices on or after this date (YYYY-MM-DD or Unix timestamp).'],
            'date_before' => ['type' => 'string', 'description' => 'Filter invoices on or before this date (YYYY-MM-DD or Unix timestamp).'],
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
                offset: $args['offset'] ?? null,
                status: $args['status'] ?? null,
                dateAfter: $args['date_after'] ?? null,
                dateBefore: $args['date_before'] ?? null,
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
                $response['next_offset'] = $nextOffset;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
