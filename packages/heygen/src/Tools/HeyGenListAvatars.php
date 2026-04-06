<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HeyGenListAvatars implements Tool
{
    public function __construct(
        private HeyGenService $service,
    ) {}

    public function name(): string
    {
        return 'heygen_list_avatars';
    }

    public function description(): string
    {
        return 'List all available talking avatars from HeyGen. Returns avatar IDs, names, preview images, and supported styles. Use avatar IDs when creating videos.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->listAvatars();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
