<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Read the current Maxio Advanced Billing site.
 *
 * Useful for verifying API credentials because Advanced Billing exposes
 * site metadata through the authenticated API.
 */
class ChargifyGetCurrentUser implements Tool
{
    /**
     * @param  ChargifyService  $service  The Chargify API client.
     */
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_get_current_user';
    }

    public function description(): string
    {
        return 'Read the current Chargify / Maxio Advanced Billing site. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Read the current site through the Chargify API.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
