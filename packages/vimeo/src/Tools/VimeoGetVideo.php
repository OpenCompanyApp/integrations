<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VimeoGetVideo implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_get_video';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Vimeo video by its ID.';
    }

    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The video ID (e.g., "123456789").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $result = $this->service->getVideo($args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
