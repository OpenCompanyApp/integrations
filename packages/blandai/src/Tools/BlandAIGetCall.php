<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: BlandAI Get Call
 *
 * Retrieves details for a specific call including status, transcript,
 * duration, and other metadata.
 */
class BlandAIGetCall implements Tool
{
    public function __construct(
        private BlandAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'blandai_get_call';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Retrieve details for a specific BlandAI phone call, including status, transcript, duration, and metadata.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the call to retrieve.'],
        ];
    }

    /**
     * Execute the tool — fetch call details.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            $result = $this->service->getCall($args['call_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
