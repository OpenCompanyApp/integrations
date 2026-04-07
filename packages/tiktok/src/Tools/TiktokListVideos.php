<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokListVideos implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_list_videos';
    }

    public function description(): string
    {
        return 'List videos available for an advertiser in TikTok Business. Returns video IDs, names, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'advertiser_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The TikTok advertiser ID.',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination. Defaults to 1.',
            ],
            'page_size' => [
                'type' => 'integer',
                'description' => 'Number of videos per page. Defaults to 10.',
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

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }

            $result = $this->service->listVideos($args['advertiser_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
