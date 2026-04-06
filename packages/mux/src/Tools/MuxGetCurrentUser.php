<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_get_current_user
 *
 * Get realtime viewer data from Mux Data. Returns current viewer counts
 * across all properties and views.
 */
class MuxGetCurrentUser implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_get_current_user';
    }

    public function description(): string
    {
        return 'Get realtime viewer data from Mux Data, including current viewer counts across all properties and views.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            $result = $this->service->getRealtime();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
