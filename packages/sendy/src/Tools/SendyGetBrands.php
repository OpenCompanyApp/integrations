<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendy\SendyService;

/**
 * List brands in a Sendy installation.
 *
 * Returns brand IDs and names visible to the configured API key.
 */
class SendyGetBrands implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    public function name(): string
    {
        return 'sendy_get_brands';
    }

    public function description(): string
    {
        return 'Get all brands available in the Sendy installation.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get all brands.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            return ToolResult::success($this->service->getBrands());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
