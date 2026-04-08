<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Litmos user.
 */
class LitmosGetCurrentUser implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Litmos user. Useful for verifying API credentials and identifying the connected account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
