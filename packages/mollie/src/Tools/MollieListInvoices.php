<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List invoices from Mollie.
 *
 * Returns the list of invoice resources for the authenticated account
 * with optional filters for year, month, and reference.
 */
class MollieListInvoices implements Tool
{
    /**
     * @param  MollieService  $service  The Mollie API client.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_list_invoices';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List invoices for the authenticated Mollie account. Supports filtering by year, month, and reference.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return (default: 50, max: 250).'],
            'from' => ['type' => 'string', 'description' => 'Invoice ID to start from for pagination.'],
            'reference' => ['type' => 'string', 'description' => 'Filter by invoice reference.'],
            'year' => ['type' => 'integer', 'description' => 'Filter by year (e.g., 2026).'],
            'month' => ['type' => 'integer', 'description' => 'Filter by month (1-12).'],
        ];
    }

    /**
     * Execute the list invoices tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }
            if (isset($args['reference'])) {
                $params['reference'] = $args['reference'];
            }
            if (isset($args['year'])) {
                $params['year'] = (int) $args['year'];
            }
            if (isset($args['month'])) {
                $params['month'] = (int) $args['month'];
            }

            $result = $this->service->listInvoices($params);

            $invoices = $result['_embedded']['invoices'] ?? [];
            $count = count($invoices);

            return ToolResult::success([
                'invoices' => $invoices,
                'count' => $count,
                '_links' => $result['_links'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
