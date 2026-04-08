<?php

namespace OpenCompany\Integrations\Knock\Tools;

use OpenCompany\Integrations\Knock\KnockService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KnockGetCurrentUser implements Tool
{
    public function __construct(
        private KnockService $service,
    ) {}

    public function name(): string
    {
        return 'knock_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Knock user. Useful for verifying API credentials and inspecting account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Knock integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
