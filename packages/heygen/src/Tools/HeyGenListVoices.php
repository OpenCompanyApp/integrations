<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HeyGenListVoices implements Tool
{
    public function __construct(
        private HeyGenService $service,
    ) {}

    public function name(): string
    {
        return 'heygen_list_voices';
    }

    public function description(): string
    {
        return 'List all available voices from HeyGen. Returns voice IDs, display names, supported languages, gender, and preview audio URLs. Use voice IDs when creating videos.';
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

            $result = $this->service->listVoices();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
