<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List meetings for a user.
 *
 * Returns an array of meeting objects including id, topic, type, start_time,
 * duration, timezone, and join_url.
 */
class ZoomListMeetings implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_meetings';
    }

    public function description(): string
    {
        return 'List meetings for a Zoom user. Returns meeting IDs, topics, start times, durations, and join URLs. Use type "live" for in-progress, "scheduled" for upcoming, or "upcoming" for all upcoming meetings.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'description' => 'User ID or "me" for the authenticated user. Default: "me".'],
            'type' => ['type' => 'string', 'description' => 'Meeting type filter: scheduled, live, or upcoming. Default: "live".'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of meetings per page (1–300). Default: 30.'],
            'next_page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $userId = $args['user_id'] ?? 'me';
            $type = $args['type'] ?? 'live';
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 30;
            $nextPageToken = $args['next_page_token'] ?? '';

            $result = $this->service->listMeetings($userId, $type, $pageSize, $nextPageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
