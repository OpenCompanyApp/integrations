<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * Get the currently authenticated Zoho Invoice user's profile.
 */
class ZohoInvoiceGetCurrentUser implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s profile from Zoho Invoice, including name, email, and role.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
