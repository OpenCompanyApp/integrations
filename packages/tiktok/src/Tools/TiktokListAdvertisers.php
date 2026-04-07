<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokListAdvertisers implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_list_advertisers';
    }

    public function description(): string
    {
        return 'List advertisers accessible to the authenticated TikTok Business user. Returns advertiser IDs, names, and company details.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => [
                'type' => 'string',
                'description' => 'The TikTok app ID to filter advertisers by.',
            ],
            'secret' => [
                'type' => 'string',
                'description' => 'The TikTok app secret to filter advertisers by.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TikTok integration is not configured.');
            }

            $params = [];

            if (isset($args['app_id'])) {
                $params['app_id'] = $args['app_id'];
            }

            if (isset($args['secret'])) {
                $params['secret'] = $args['secret'];
            }

            $result = $this->service->listAdvertisers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
