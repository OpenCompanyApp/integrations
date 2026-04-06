<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Export a list of users from Braze.
 *
 * Supports exporting users by segment ID or by providing an array of external IDs.
 * Returns user profile data including attributes, custom attributes, and subscription state.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/user_data/post_users_export/
 */
class BrazeListUsers implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_list_users';
    }

    public function description(): string
    {
        return 'Export users from Braze by segment ID or external IDs. Returns user profile data including attributes and subscription state. Provide either a segment_id to get users in a segment, or external_ids to look up specific users.';
    }

    public function parameters(): array
    {
        return [
            'external_ids' => ['type' => 'array', 'description' => 'Array of external user IDs to export (e.g., ["user-123", "user-456"]).'],
            'segment_id' => ['type' => 'string', 'description' => 'Braze segment ID to export users from.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (max 5000, default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            $externalIds = $args['external_ids'] ?? null;
            $segmentId = $args['segment_id'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;

            if ($externalIds === null && $segmentId === null) {
                return ToolResult::error('Provide either external_ids or segment_id to look up users.');
            }

            $result = $this->service->exportUsers($externalIds, $segmentId, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
