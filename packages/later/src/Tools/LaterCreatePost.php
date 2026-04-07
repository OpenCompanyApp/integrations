<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new post in Later.
 *
 * Schedules or creates a social media post for one or more
 * connected social profiles, with optional media attachments.
 */
class LaterCreatePost implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_create_post';
    }

    public function description(): string
    {
        return 'Create and schedule a new social media post in Later. Provide the caption text, target profile IDs, and optionally a scheduled time or media URL.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The caption or text content of the post.'],
            'profileIds' => ['type' => 'array', 'required' => true, 'description' => 'Array of Later profile IDs to publish the post to.'],
            'scheduledAt' => ['type' => 'string', 'description' => 'ISO 8601 timestamp for when the post should be published (e.g., "2025-02-01T09:00:00Z").'],
            'mediaUrl' => ['type' => 'string', 'description' => 'URL of the media (image or video) to attach to the post.'],
            'mediaType' => ['type' => 'string', 'description' => 'Type of media: "image" or "video".'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the post.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            if (empty($args['profileIds'])) {
                return ToolResult::error('At least one profileId is required.');
            }

            $result = $this->service->createPost(
                text: $args['text'],
                profileIds: $args['profileIds'],
                scheduledAt: $args['scheduledAt'] ?? null,
                mediaUrl: $args['mediaUrl'] ?? null,
                mediaType: $args['mediaType'] ?? null,
                title: $args['title'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
