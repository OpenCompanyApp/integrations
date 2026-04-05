<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Leads.
 *
 * Searches and lists leads in Close CRM. Supports Close's powerful search
 * syntax for filtering by name, status, custom fields, and more.
 *
 * @see https://developer.close.com/resources/leads/#list-leads
 */
class CloseListLeads implements Tool
{
    /**
     * @param  CloseService  $service  The Close API service instance.
     */
    public function __construct(
        private CloseService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'close_list_leads';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Search and list leads in Close CRM. Use the query parameter with Close search syntax to filter leads by name, status, custom fields, dates, and more. Returns a paginated list of leads with their contacts and addresses.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query using Close syntax. Examples: "Acme", "status:Potential", "name:Acme AND status:Qualified". Omit to list all leads.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of leads to return (default: 25, max: 100).'],
            'skip'  => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    /**
     * Execute the list leads tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, limit, skip).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $query = $args['query'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $skip  = isset($args['skip']) ? (int) $args['skip'] : null;

            $result = $this->service->listLeads($query, $limit, $skip);

            $leads    = $result['data'] ?? [];
            $total    = $result['total_results'] ?? count($leads);
            $hasMore  = ($result['_skip'] ?? 0) + count($leads) < $total;

            return ToolResult::success([
                'leads'      => $leads,
                'count'      => count($leads),
                'total'      => $total,
                'has_more'   => $hasMore,
                '_skip'      => $result['_skip'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
