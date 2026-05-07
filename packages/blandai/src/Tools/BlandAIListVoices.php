<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * List Bland AI voices.
 *
 * Returns curated and custom voices available to the account.
 */
class BlandAIListVoices implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_list_voices';
    }

    public function description(): string
    {
        return 'List Bland AI voices available for calls.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List voices.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->listVoices());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
