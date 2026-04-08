<?php

namespace OpenCompany\Integrations\NetSuite\Tools;

use OpenCompany\Integrations\NetSuite\NetSuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetSuiteListInvoices implements Tool
{
    /**
     * Create a new NetSuiteListInvoices tool instance.
     */
    public function __construct(
        private NetSuiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'netsuite_list_invoices';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List invoices from NetSuite ERP. Returns invoice records with amounts, statuses, customer references, and dates. Use limit and offset for pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of invoices to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Zero-based offset for pagination.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NetSuite integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listInvoices($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
