<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: BlandAI List Calls
 *
 * Lists phone calls with optional pagination and filtering.
 * Useful for reviewing call history and finding specific calls.
 */
class BlandAIListCalls implements Tool
{
    public function __construct(
        private BlandAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'blandai_list_calls';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List BlandAI phone calls with optional pagination. Returns call summaries including status, duration, and phone numbers.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of calls to return (default: 50).'],
            'after' => ['type' => 'string', 'description' => 'Cursor value from the previous response.'],
            'from_number' => ['type' => 'string', 'description' => 'Filter by dispatching phone number.'],
            'to_number' => ['type' => 'string', 'description' => 'Filter by called phone number.'],
            'batch_id' => ['type' => 'string', 'description' => 'Filter by batch ID.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date/time filter.'],
            'end_date' => ['type' => 'string', 'description' => 'End date/time filter.'],
        ];
    }

    /**
     * Execute the tool — list calls.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            $filters = [];
            foreach (['limit', 'after', 'from_number', 'to_number', 'batch_id', 'start_date', 'end_date'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listCalls($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
