<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokUploadVideo implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_upload_video';
    }

    public function description(): string
    {
        return 'Upload a video to TikTok via URL for use in advertising campaigns.';
    }

    public function parameters(): array
    {
        return [
            'advertiser_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok advertiser ID.',
            ],
            'video_url' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The URL of the video to upload (must be publicly accessible).',
            ],
            'file_name' => [
                'type' => 'string',
                'description' => 'A custom name for the uploaded video file.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TikTok integration is not configured.');
            }

            if (empty($args['advertiser_id'])) {
                return ToolResult::error('advertiser_id is required.');
            }

            if (empty($args['video_url'])) {
                return ToolResult::error('video_url is required.');
            }

            $params = [];

            if (isset($args['file_name'])) {
                $params['file_name'] = $args['file_name'];
            }

            $result = $this->service->uploadVideo($args['advertiser_id'], $args['video_url'], $params);

            $videoId = $result['data']['video_id'] ?? 'unknown';

            return ToolResult::success([
                'video_id' => $videoId,
                'message' => "Video uploaded successfully (ID: {$videoId}).",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
