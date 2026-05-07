<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Stop one active Bland AI call.
 *
 * Ends an in-progress call by call ID.
 */
class BlandAIStopCall implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_stop_call';
    }

    public function description(): string
    {
        return 'Stop an active Bland AI call by call ID.';
    }

    public function parameters(): array
    {
        return ['call_id' => ['type' => 'string', 'required' => true, 'description' => 'Call ID to stop.']];
    }

    /**
     * Stop an active call.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->stopCall((string) ($args['call_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
