<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushbulletGetCurrentUser implements Tool
{
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Pushbullet user\'s profile information, including name, email, and account details.';
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
