<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current fal.ai user profile.
 *
 * Returns the authenticated user's profile information including
 * account details and usage metadata.
 */
class FalGetCurrentUser implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_get_current_user';
    }

    public function description(): string
    {
        return 'Get current fal.ai user profile and account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('fal.ai integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
