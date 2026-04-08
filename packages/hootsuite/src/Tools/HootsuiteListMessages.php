<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List scheduled and past messages in Hootsuite.
 *
 * Retrieves messages for the authenticated user, optionally filtered by
 * time range, social profile IDs, and result limit.
 */
class HootsuiteListMessages implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_list_messages';
    }

    public function description(): string
    {
        return 'List scheduled and past messages in Hootsuite. Filter by time range, social profiles, and limit. Returns message IDs, text, scheduled send times, and status.';
    }

    public function parameters(): array
    {
        return [
            'startTime' => ['type' => 'string', 'description' => 'Start of time range in ISO 8601 format (e.g., "2025-01-01T00:00:00Z").'],
            'endTime' => ['type' => 'string', 'description' => 'End of time range in ISO 8601 format (e.g., "2025-01-31T23:59:59Z").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return.'],
            'socialProfileIds' => ['type' => 'array', 'description' => 'Array of social profile IDs to filter messages by.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            $result = $this->service->listMessages(
                startTime: $args['startTime'] ?? null,
                endTime: $args['endTime'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                socialProfileIds: $args['socialProfileIds'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
