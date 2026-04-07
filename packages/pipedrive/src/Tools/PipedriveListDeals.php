<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Deals.
 *
 * Lists deals in Pipedrive with optional filters for user, person, organization,
 * and status. Returns a paginated list of deals.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Deals#getDeals
 */
class PipedriveListDeals implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API service instance.
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pipedrive_list_deals';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List deals in Pipedrive with optional filters for user, person, organization, and status. Returns a paginated list of deals with key details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'user_id'   => ['type' => 'integer', 'description' => 'Filter deals by user ID (the user the deal is assigned to).'],
            'person_id' => ['type' => 'integer', 'description' => 'Filter deals by person ID.'],
            'org_id'    => ['type' => 'integer', 'description' => 'Filter deals by organization ID.'],
            'status'    => ['type' => 'string', 'description' => 'Filter by status: "open", "won", "lost", or "deleted". Omit to return all.'],
            'limit'     => ['type' => 'integer', 'description' => 'Maximum number of deals to return (default: 25, max: 500).'],
            'start'     => ['type' => 'integer', 'description' => 'Pagination start offset (0-based).'],
        ];
    }

    /**
     * Execute the list deals tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, person_id, org_id, status, limit, start).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $userId   = isset($args['user_id']) ? (int) $args['user_id'] : null;
            $personId = isset($args['person_id']) ? (int) $args['person_id'] : null;
            $orgId    = isset($args['org_id']) ? (int) $args['org_id'] : null;
            $status   = $args['status'] ?? null;
            $limit    = isset($args['limit']) ? (int) $args['limit'] : 25;
            $start    = isset($args['start']) ? (int) $args['start'] : 0;

            $result = $this->service->listDeals($userId, $personId, $orgId, $status, $limit, $start);

            $deals   = $result['data'] ?? [];
            $more    = $result['additional_data']['pagination']['more_items_in_collection'] ?? false;

            return ToolResult::success([
                'deals'    => $deals,
                'count'    => count($deals),
                'has_more' => $more,
                'start'    => $start,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
