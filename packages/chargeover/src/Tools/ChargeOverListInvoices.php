<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChargeOver invoices with documented API filters.
 */
class ChargeOverListInvoices implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_invoices';
    }

    public function description(): string
    {
        return 'List invoices from ChargeOver. Supports limit/offset pagination, where filters such as date:GTE:2026-01-01, sorting, and optional expansion.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return per page (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Record offset for pagination (default: 0).'],
            'where' => ['type' => 'string', 'description' => 'ChargeOver where expression, e.g. invoice_status_state:EQUALS:o or date:GTE:2026-01-01.'],
            'order' => ['type' => 'string', 'description' => 'Sort expression, e.g. invoice_id:DESC or total:ASC.'],
            'expand' => ['type' => 'string', 'description' => 'Optional ChargeOver expand value when supported by the endpoint.'],
            'status' => ['type' => 'string', 'description' => 'Legacy shortcut mapped to invoice_status_state:EQUALS:{status}.'],
        ];
    }

    /**
     * List invoices through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, where, order, expand, status).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $where = $args['where'] ?? null;

            if ($where === null && isset($args['status'])) {
                $where = 'invoice_status_state:EQUALS:' . $args['status'];
            }

            $result = $this->service->listInvoices(
                $limit,
                $offset,
                $where,
                $args['order'] ?? null,
                $args['expand'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
