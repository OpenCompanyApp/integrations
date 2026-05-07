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
            'goal' => ['type' => 'string', 'description' => 'Overall purpose of the analysis.'],
            'questions' => ['type' => 'array', 'description' => 'Array of [question, expected_type] pairs.'],
            'prompt' => ['type' => 'string', 'description' => 'Backward-compatible alias for goal when questions are omitted.'],
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

            $goal = (string) ($args['goal'] ?? $args['prompt'] ?? '');
            if ($goal === '') {
                return ToolResult::error('goal is required.');
            }
            $questions = $args['questions'] ?? [];
            if (! is_array($questions)) {
                return ToolResult::error('questions must be an array when provided.');
            }

            $result = $this->service->analyzeCall($args['call_id'], $goal, $questions);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
