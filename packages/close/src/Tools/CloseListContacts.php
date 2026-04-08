<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts.
 *
 * Lists contacts in Close CRM with optional filtering by lead ID and
 * pagination support.
 *
 * @see https://developer.close.com/resources/contacts/#list-contacts
 */
class CloseListContacts implements Tool
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
        return 'close_list_contacts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List contacts in Close CRM. Optionally filter by lead ID to get contacts for a specific lead. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'description' => 'Filter contacts by lead ID (e.g., "lead_abc123XYZ").'],
            'limit'   => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 25, max: 100).'],
            'skip'    => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id, limit, skip).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $leadId = $args['lead_id'] ?? null;
            $limit  = isset($args['limit']) ? (int) $args['limit'] : 25;
            $skip   = isset($args['skip']) ? (int) $args['skip'] : null;

            $result = $this->service->listContacts($leadId, $limit, $skip);

            $contacts = $result['data'] ?? [];
            $total    = $result['total_results'] ?? count($contacts);
            $hasMore  = ($result['_skip'] ?? 0) + count($contacts) < $total;

            return ToolResult::success([
                'contacts'   => $contacts,
                'count'      => count($contacts),
                'total'      => $total,
                'has_more'   => $hasMore,
                '_skip'      => $result['_skip'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
