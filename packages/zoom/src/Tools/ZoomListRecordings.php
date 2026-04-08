<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List cloud recordings for a user.
 *
 * Returns an array of recording objects including id, topic, start_time,
 * duration, recording_files with download URLs, and share_url.
 */
class ZoomListRecordings implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_recordings';
    }

    public function description(): string
    {
        return 'List cloud recordings for a Zoom user. Returns recording IDs, topics, start times, durations, and download URLs for recording files.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'description' => 'User ID or "me" for the authenticated user. Default: "me".'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of recordings per page (1–300). Default: 30.'],
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
            $nextPageToken = $args['next_page_token'] ?? '';
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 30;

            $result = $this->service->listRecordings($userId, $nextPageToken, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
