<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Stop all active Bland AI calls.
 *
 * Uses Bland AI's account-wide active-call stop endpoint.
 */
class BlandAIStopAllActiveCalls implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_stop_all_active_calls';
    }

    public function description(): string
    {
        return 'Stop all currently active Bland AI calls on the account.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Stop all active calls.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->stopAllActiveCalls());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
