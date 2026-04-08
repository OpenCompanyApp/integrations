<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: BlandAI Analyze Call
 *
 * Analyzes a completed call's transcript using a custom prompt.
 * Useful for extracting insights, summarizing conversations, or evaluating
 * call outcomes programmatically.
 */
class BlandAIAnalyzeCall implements Tool
{
    public function __construct(
        private BlandAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'blandai_analyze_call';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Analyze a BlandAI call transcript with a custom prompt. Extract insights, summarize the conversation, or evaluate call outcomes.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the call to analyze.'],
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Analysis prompt describing what to extract or evaluate from the transcript (e.g., "Summarize the key points discussed", "Was the customer satisfied?").'],
        ];
    }

    /**
     * Execute the tool — analyze a call transcript.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            $result = $this->service->analyzeCall(
                $args['call_id'],
                $args['prompt'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
