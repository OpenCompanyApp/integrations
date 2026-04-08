<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sent (posted) updates for a Buffer profile.
 *
 * Retrieves updates that have already been published, optionally
 * paginated with count and page parameters.
 */
class BufferListSentUpdates implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_list_sent_updates';
    }

    public function description(): string
    {
        return 'List already posted (sent) updates for a Buffer profile. Returns update IDs, text content, sent times, and engagement metrics. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'required' => true, 'description' => 'The social profile ID to list sent updates for.'],
            'count' => ['type' => 'integer', 'description' => 'Number of updates to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            $result = $this->service->listSentUpdates(
                profileId: $args['profileId'],
                count: isset($args['count']) ? (int) $args['count'] : null,
                page: isset($args['page']) ? (int) $args['page'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
