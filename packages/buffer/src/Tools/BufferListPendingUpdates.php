<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pending (scheduled) updates for a Buffer profile.
 *
 * Retrieves updates that have been scheduled but not yet posted,
 * optionally paginated with count and page parameters.
 */
class BufferListPendingUpdates implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_list_pending_updates';
    }

    public function description(): string
    {
        return 'List scheduled (pending) updates for a Buffer profile. Returns update IDs, text content, scheduled times, and status. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'required' => true, 'description' => 'The social profile ID to list pending updates for.'],
            'count' => ['type' => 'integer', 'description' => 'Number of updates to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'since' => ['type' => 'integer', 'description' => 'Only return updates created after this Unix timestamp.'],
            'utc' => ['type' => 'boolean', 'description' => 'Return times relative to UTC.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            $result = $this->service->listPendingUpdates(
                profileId: $args['profileId'],
                count: isset($args['count']) ? (int) $args['count'] : null,
                page: isset($args['page']) ? (int) $args['page'] : null,
                since: isset($args['since']) ? (int) $args['since'] : null,
                utc: isset($args['utc']) ? (bool) $args['utc'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
