<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VimeoDeleteVideo implements Tool
{
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

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $this->service->deleteVideo($args['video_id']);

            return ToolResult::success("Video '{$args['video_id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
