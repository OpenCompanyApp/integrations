<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushbulletListDevices implements Tool
{
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_list_devices';
    }

    public function description(): string
    {
        return 'List all devices registered with the current user\'s Pushbullet account. Returns device names, types, and identifiers.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $result = $this->service->listDevices();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
