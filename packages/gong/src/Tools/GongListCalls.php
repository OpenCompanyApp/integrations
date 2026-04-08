<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing call recordings from Gong.
 *
 * Supports filtering by date range, workspace, and other criteria
 * via the Gong POST /v2/calls endpoint.
 */
class GongListCalls implements Tool
{
    /**
     * Create a new GongListCalls tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_list_calls';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List call recordings from Gong. Filter by date range, participants, or other criteria. Returns call metadata including title, duration, participants, and timestamps.';
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
            'workspaceId' => ['type' => 'string', 'description' => 'Workspace ID to filter calls by.'],
            'userId' => ['type' => 'array', 'description' => 'Array of user IDs to filter calls by.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of calls to return (default: 100).'],
        ];
    }

    /**
     * Execute the list calls tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing call data or an error message.
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
            if (isset($args['workspaceId'])) {
                $body['workspaceId'] = $args['workspaceId'];
            }
            if (isset($args['userId'])) {
                $body['userId'] = $args['userId'];
            }
            if (isset($args['cursor'])) {
                $body['cursor'] = $args['cursor'];
            }

            $result = $this->service->listCalls($body);

            $calls = $result['calls'] ?? [];
            $totalCount = count($calls);
            $response = [
                'calls' => $calls,
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
