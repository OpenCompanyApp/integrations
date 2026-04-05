<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List meetings for a Zoom user.
 *
 * Retrieves all meetings (scheduled, live, upcoming) for the
 * specified user with optional filtering by type and pagination.
 */
class ZoomListMeetings implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_meetings';
    }

    public function description(): string
    {
        return 'List meetings for a Zoom user. Filter by type (scheduled, live, upcoming) with pagination.';
    }

    public function parameters(): array
    {
        return [
            'user_id'         => ['type' => 'string', 'required' => true, 'description' => 'User ID or email address.'],
            'type'            => ['type' => 'string', 'description' => 'Meeting type filter: "scheduled", "live", "upcoming". Default: "live".'],
            'page_size'       => ['type' => 'integer', 'description' => 'Number of records returned per page (default 30, max 300).'],
            'next_page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    /**
     * List meetings for a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, type, page_size, next_page_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $params = [];

            if (isset($args['type'])) {
                $params['type'] = $args['type'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['next_page_token'])) {
                $params['next_page_token'] = $args['next_page_token'];
            }

            $result = $this->service->listMeetings($userId, $params);

            return ToolResult::success([
                'meetings' => $result['meetings'] ?? [],
                'page_count' => $result['page_count'] ?? 0,
                'total_records' => $result['total_records'] ?? 0,
                'next_page_token' => $result['next_page_token'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
