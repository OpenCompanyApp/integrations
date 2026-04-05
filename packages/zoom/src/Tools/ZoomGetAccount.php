<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current Zoom account information.
 *
 * Retrieves account details including plan type, billing,
 * and account-wide settings.
 */
class ZoomGetAccount implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_account';
    }

    public function description(): string
    {
        return 'Get the current Zoom account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve current account info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $result = $this->service->getAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
