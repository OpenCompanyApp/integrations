<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new update (post) in Buffer.
 *
 * Schedules or immediately posts a social media update to one or
 * more connected social profiles.
 */
class BufferCreateUpdate implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_create_update';
    }

    public function description(): string
    {
        return 'Create and schedule a new social media update in Buffer. Provide the text content, target profile IDs, and optionally a scheduled time or media attachments.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the update to post.'],
            'profileIds' => ['type' => 'array', 'required' => true, 'description' => 'Array of Buffer profile IDs to publish the update to.'],
            'shorten' => ['type' => 'boolean', 'description' => 'Whether to automatically shorten links (default true).'],
            'now' => ['type' => 'boolean', 'description' => 'Post immediately instead of scheduling (default false).'],
            'scheduledAt' => ['type' => 'string', 'description' => 'ISO 8601 timestamp for when the update should be sent (e.g., "2025-02-01T09:00:00Z").'],
            'media' => ['type' => 'object', 'description' => 'Media attachments such as photo URL, link, or thumbnail.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            if (empty($args['profileIds'])) {
                return ToolResult::error('At least one profileId is required.');
            }

            $result = $this->service->createUpdate(
                text: $args['text'],
                profileIds: $args['profileIds'],
                shorten: $args['shorten'] ?? true,
                now: $args['now'] ?? false,
                scheduledAt: $args['scheduledAt'] ?? null,
                media: $args['media'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
