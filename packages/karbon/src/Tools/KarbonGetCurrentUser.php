<?php

namespace OpenCompany\Integrations\Karbon\Tools;

use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KarbonGetCurrentUser implements Tool
{
    public function __construct(
        private KarbonService $service,
    ) {}

    public function name(): string
    {
        return 'karbon_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Karbon user. Returns the profile of the user whose access token is configured for this integration.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Karbon integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
