<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Clients.
 *
 * Lists clients from Invoice Ninja with optional filtering and pagination.
 */
class InvoiceNinjaListClients implements Tool
{
    /**
     * Create a new InvoiceNinjaListClients tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_list_clients';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List clients from Invoice Ninja. Supports filtering by name, email, and ID number with pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of clients per page (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'search' => ['type' => 'string', 'description' => 'Search clients by name or email (partial match).'],
            'id_number' => ['type' => 'string', 'description' => 'Filter by client ID number.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g. "name", "balance", "created_at").'],
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
                'search' => $args['search'] ?? null,
                'id_number' => $args['id_number'] ?? null,
                'sort' => $args['sort'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listClients($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
