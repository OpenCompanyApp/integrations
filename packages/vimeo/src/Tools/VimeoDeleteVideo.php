<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Vimeo video.
 */
class VimeoDeleteVideo implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_delete_video';
    }

    public function description(): string
    {
        return 'Delete a video from Vimeo permanently. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The video ID to delete (e.g., "123456789").'],
        ];
    }

    /**
     * Delete the video.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $videoId = (string) ($args['video_id'] ?? '');
            if ($videoId === '') {
                return ToolResult::error('video_id is required.');
            }

            $this->service->deleteVideo($videoId);

            return ToolResult::success("Video '{$videoId}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
