<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the current authenticated Eden AI user's account information.
 *
 * Calls the GET /user endpoint to fetch the user's profile, including
 * email, plan details, and API usage information.
 */
class EdenAiGetCurrentUser implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current Eden AI user\'s account information, including email, plan, and usage details. Useful for verifying API connectivity and checking account status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
