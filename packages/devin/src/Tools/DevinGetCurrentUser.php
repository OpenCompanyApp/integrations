<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about the authenticated Devin principal.
 *
 * Calls the current v3 self endpoint.
 */
class DevinGetCurrentUser implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the authenticated Devin API principal. Use this to verify the current account, user, or service user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated principal.
     *
     * @param  array<string, mixed>  $args  No arguments are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
