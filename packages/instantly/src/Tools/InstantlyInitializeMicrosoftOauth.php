<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Initialize a Microsoft OAuth account connection flow.
 *
 * Returns the session ID, authorization URL, and expiration timestamp.
 */
class InstantlyInitializeMicrosoftOauth implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_initialize_microsoft_oauth';
    }

    public function description(): string
    {
        return 'Initialize a Microsoft OAuth account connection flow and return the authorization URL.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Initialize the Microsoft OAuth flow.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            return ToolResult::success($this->service->initializeMicrosoftOauth());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
