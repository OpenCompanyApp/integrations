<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get current user / account information.
 *
 * Retrieves account-level details for the authenticated Retell AI account,
 * including available agents and account status.
 */
class RetellAIGetCurrentUser implements Tool
{
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_get_current_user';
    }

    public function description(): string
    {
        return 'Retrieve current Retell AI account information, including available agents and account status. Useful for verifying connectivity and understanding account capabilities.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
