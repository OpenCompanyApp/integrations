<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Keap user.
 *
 * Returns profile information about the user associated with the
 * configured access token. Useful for verifying the connection
 * and identifying which Keap account is active.
 */
class KeapGetCurrentUser implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Keap user. Returns profile information for the user associated with the access token.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
