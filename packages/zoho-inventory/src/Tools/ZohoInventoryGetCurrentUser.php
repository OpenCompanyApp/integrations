<?php

namespace OpenCompany\Integrations\ZohoInventory\Tools;

use OpenCompany\Integrations\ZohoInventory\ZohoInventoryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Zoho Inventory user.
 */
class ZohoInventoryGetCurrentUser implements Tool
{
    public function __construct(
        private ZohoInventoryService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_inventory_get_current_user';
    }

    public function description(): string
    {
        return 'Get details of the currently authenticated Zoho Inventory user. Useful for verifying credentials and checking permissions.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Inventory integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
