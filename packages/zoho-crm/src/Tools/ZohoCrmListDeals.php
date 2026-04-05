<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals in Zoho CRM with pagination, field selection, and sorting.
 *
 * Returns a paginated list of deal records with their fields.
 */
class ZohoCrmListDeals implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_list_deals';
    }

    public function description(): string
    {
        return <<<'MD'
        List deals in Zoho CRM with pagination, field selection, and sorting.
        Control page number, page size, which fields to return, and sort order.
        MD;
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'array', 'description' => 'List of field API names to include in results.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page (default 200).'],
            'sort_by' => ['type' => 'string', 'description' => 'Field API name to sort by (e.g. "Created_Time").'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    /**
     * List Zoho CRM deals with pagination and sorting.
     *
     * @param  array<string, mixed>  $args  Tool arguments (fields, page, per_page, sort_by, sort_order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $fields = $args['fields'] ?? null;
            $page = $args['page'] ?? null;
            $perPage = $args['per_page'] ?? null;
            $sortBy = $args['sort_by'] ?? null;
            $sortOrder = $args['sort_order'] ?? null;

            $result = $this->service->listDeals(
                is_array($fields) ? $fields : null,
                is_numeric($page) ? (int) $page : null,
                is_numeric($perPage) ? (int) $perPage : null,
                is_string($sortBy) && $sortBy !== '' ? $sortBy : null,
                is_string($sortOrder) && $sortOrder !== '' ? $sortOrder : null,
            );

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
                'count' => count($data),
                'info' => $result['info'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
