<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Organizations.
 *
 * Lists organizations in Pipedrive with pagination support.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Organizations#getOrganizations
 */
class PipedriveListOrganizations implements Tool
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
        return 'pipedrive_list_organizations';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List organizations in Pipedrive. Returns a paginated list with name, address, owner, and other details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return (default: 25, max: 500).'],
            'start' => ['type' => 'integer', 'description' => 'Pagination start offset (0-based).'],
        ];
    }

    /**
     * Execute the list organizations tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, start).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $start = isset($args['start']) ? (int) $args['start'] : 0;

            $result = $this->service->listOrganizations($limit, $start);

            $orgs = $result['data'] ?? [];
            $more = $result['additional_data']['pagination']['more_items_in_collection'] ?? false;

            return ToolResult::success([
                'organizations' => $orgs,
                'count'         => count($orgs),
                'has_more'      => $more,
                'start'         => $start,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
