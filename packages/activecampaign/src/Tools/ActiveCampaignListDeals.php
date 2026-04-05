<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list deals from ActiveCampaign with pagination and filters.
 */
class ActiveCampaignListDeals implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_list_deals';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List deals from ActiveCampaign. Supports pagination, search, and filtering by pipeline, stage, status, or owner.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of deals to return per page (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter deals by title.'],
            'filters' => ['type' => 'object', 'description' => 'Additional filters (e.g., {"pipeline": 1, "stage": 2, "status": 0}, status: 0=open, 1=won, 2=lost, 3=abandoned).'],
        ];
    }

    /**
     * Execute the tool: list deals from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (limit, offset, search, filters).
     * @return ToolResult      The result containing deals or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $result = $this->service->listDeals(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
                search: $args['search'] ?? null,
                filters: $args['filters'] ?? [],
            );

            $deals = $result['deals'] ?? [];
            $meta = $result['meta'] ?? [];

            $statusMap = [0 => 'open', 1 => 'won', 2 => 'lost', 3 => 'abandoned'];

            $response = [
                'deals' => array_map(fn(array $d) => [
                    'id' => (int) ($d['id'] ?? 0),
                    'title' => $d['title'] ?? '',
                    'value' => isset($d['value']) ? (float) $d['value'] : 0,
                    'currency' => $d['currency'] ?? '',
                    'status' => $statusMap[(int) ($d['status'] ?? 0)] ?? $d['status'] ?? '',
                    'contact_id' => (int) ($d['contact'] ?? 0),
                    'stage' => $d['stage'] ?? '',
                    'pipeline' => $d['pipeline'] ?? '',
                    'owner' => $d['owner'] ?? '',
                    'created' => $d['cdate'] ?? null,
                    'updated' => $d['udate'] ?? null,
                ], $deals),
                'total' => $meta['total'] ?? count($deals),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
