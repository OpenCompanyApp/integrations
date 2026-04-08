<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create (publish) a new media item on Instagram.
 *
 * Creates a media container and optionally publishes it immediately.
 * Supports images and videos via URL.
 */
class InstagramCreateMedia implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_create_media';
    }

    public function description(): string
    {
        return 'Publish a new media item (photo or video) to Instagram. Provide the media URL and an optional caption. The media is published immediately unless publish is set to false.';
    }

    public function parameters(): array
    {
        return [
            'imageUrl' => ['type' => 'string', 'required' => true, 'description' => 'URL of the image or video to publish.'],
            'caption' => ['type' => 'string', 'description' => 'Caption text for the media post.'],
            'mediaType' => ['type' => 'string', 'description' => 'Type of media: "IMAGE", "VIDEO", or "CAROUSEL". Defaults to "IMAGE".'],
            'publish' => ['type' => 'boolean', 'description' => 'Whether to publish immediately (default true). Set to false to create a container only.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            if (empty($args['imageUrl'])) {
                return ToolResult::error('imageUrl is required.');
            }

            $result = $this->service->createMedia(
                imageUrl: $args['imageUrl'],
                caption: $args['caption'] ?? null,
                mediaType: $args['mediaType'] ?? null,
                publish: $args['publish'] ?? true,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
