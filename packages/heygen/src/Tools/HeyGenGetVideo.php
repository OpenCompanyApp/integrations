<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HeyGenGetVideo implements Tool
{
    public function __construct(
        private HeyGenService $service,
    ) {}

    public function name(): string
    {
        return 'heygen_get_video';
    }

    public function description(): string
    {
        return 'Get the status and details of a specific HeyGen video. Returns the video status (pending, processing, completed, failed), download URL when ready, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the video to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            if (empty($args['video_id'])) {
                return ToolResult::error('video_id is required.');
            }

            $result = $this->service->getVideo($args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
