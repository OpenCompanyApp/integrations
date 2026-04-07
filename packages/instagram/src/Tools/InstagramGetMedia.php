<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Instagram media item by ID.
 *
 * Retrieves full details for a specific media item including
 * caption, media URLs, timestamps, like and comment counts.
 */
class InstagramGetMedia implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_get_media';
    }

    public function description(): string
    {
        return 'Get details of a specific Instagram media item by its ID. Returns caption, media type, URL, timestamp, like count, and comment count.';
    }

    public function parameters(): array
    {
        return [
            'mediaId' => ['type' => 'string', 'required' => true, 'description' => 'The media ID to retrieve.'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of fields to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            if (empty($args['mediaId'])) {
                return ToolResult::error('mediaId is required.');
            }

            $result = $this->service->getMedia(
                mediaId: $args['mediaId'],
                fields: $args['fields'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
