<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new post in Sprout Social.
 *
 * Schedules or publishes a social media post to one or
 * more connected social profiles.
 */
class SproutSocialCreatePost implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_create_post';
    }

    public function description(): string
    {
        return 'Create and schedule a new social media post in Sprout Social. Provide the text content, target profile IDs, and optionally a scheduled time or media attachments.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the post.'],
            'profileIds' => ['type' => 'array', 'required' => true, 'description' => 'Array of Sprout Social profile IDs to publish the post to.'],
            'scheduledAt' => ['type' => 'string', 'description' => 'ISO 8601 timestamp for when the post should be sent (e.g., "2025-02-01T09:00:00Z").'],
            'media' => ['type' => 'object', 'description' => 'Media attachments such as photo URL, link, or thumbnail.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            if (empty($args['profileIds'])) {
                return ToolResult::error('At least one profileId is required.');
            }

            $result = $this->service->createPost(
                text: $args['text'],
                profileIds: $args['profileIds'],
                scheduledAt: $args['scheduledAt'] ?? null,
                media: $args['media'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
