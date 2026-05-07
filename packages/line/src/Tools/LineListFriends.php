<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LINE follower user IDs.
 *
 * Uses the documented followers/ids endpoint.
 */
class LineListFriends implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_list_friends';
    }

    public function description(): string
    {
        return 'List the friends (followers) of the LINE Official Account. Returns user IDs that can be used with send_message and get_profile.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of friends to return (default: 100, max: 1000).'],
            'start' => ['type' => 'string', 'description' => 'Continuation token from a previous response to fetch the next page of results.'],
        ];
    }

    /**
     * List follower IDs.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $start = $args['start'] ?? null;

            $result = $this->service->listFriends($limit, $start);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
