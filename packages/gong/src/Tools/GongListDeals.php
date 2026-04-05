<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing deals from Gong.
 *
 * Retrieves deal data tracked in Gong via the POST /v2/deals endpoint,
 * supporting date range filtering and pagination.
 */
class GongListDeals implements Tool
{
    /**
     * Create a new GongListDeals tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_list_deals';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List deals tracked in Gong. Filter by date range or pipeline stage. Returns deal metadata including name, stage, amount, and associated users.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'fromDateTime' => ['type' => 'string', 'description' => 'Start of date range in ISO 8601 format (e.g., "2025-01-01T00:00:00Z").'],
            'toDateTime' => ['type' => 'string', 'description' => 'End of date range in ISO 8601 format (e.g., "2025-01-31T23:59:59Z").'],
            'pipelineId' => ['type' => 'string', 'description' => 'Pipeline ID to filter deals by.'],
            'stageIds' => ['type' => 'array', 'description' => 'Array of stage IDs to filter deals by.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deals to return (default: 100).'],
        ];
    }

    /**
     * Execute the list deals tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing deal data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $body = [];

            if (isset($args['fromDateTime'])) {
                $body['fromDateTime'] = $args['fromDateTime'];
            }
            if (isset($args['toDateTime'])) {
                $body['toDateTime'] = $args['toDateTime'];
            }
            if (isset($args['pipelineId'])) {
                $body['pipelineId'] = $args['pipelineId'];
            }
            if (isset($args['stageIds'])) {
                $body['stageIds'] = $args['stageIds'];
            }
            if (isset($args['cursor'])) {
                $body['cursor'] = $args['cursor'];
            }

            $result = $this->service->listDeals($body);

            $deals = $result['deals'] ?? [];
            $totalCount = count($deals);
            $response = [
                'deals' => $deals,
                'count' => $totalCount,
            ];

            if (isset($result['records'])) {
                $response['totalRecords'] = $result['records']['totalRecords'] ?? $totalCount;
            }
            if (isset($result['cursor'])) {
                $response['cursor'] = $result['cursor'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
