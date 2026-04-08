<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokGetVideo implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_get_video';
    }

    public function description(): string
    {
        return 'Get details for a specific TikTok video, including preview URL, duration, and status.';
    }

    public function parameters(): array
    {
        return [
            'advertiser_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok advertiser ID.',
            ],
            'video_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok video ID.',
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

            if (empty($args['video_id'])) {
                return ToolResult::error('video_id is required.');
            }

            $result = $this->service->getVideo($args['advertiser_id'], $args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
