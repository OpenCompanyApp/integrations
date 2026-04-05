<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearGetVideo implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_get_video';
    }

    public function description(): string
    {
        return 'Retrieve the status and download URL of a previously created Bannerbear video. Videos are generated asynchronously, so poll this endpoint until status is "completed".';
    }

    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The video UID returned by create_video.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $result = $this->service->getVideo($args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
