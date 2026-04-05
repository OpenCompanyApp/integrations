<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List phone calls with optional filters.
 *
 * Returns a list of calls with their statuses, durations, and metadata.
 * Can be filtered by agent, status, or date range.
 */
class RetellAIListCalls implements Tool
{
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_list_calls';
    }

    public function description(): string
    {
        return 'List phone calls from Retell AI. Returns call records with status, duration, and metadata. Supports optional filters for agent, status, or date range.';
    }

    public function parameters(): array
    {
        return [
            'filter' => ['type' => 'object', 'description' => 'Optional filters to apply. Supported keys may include agent_id, status, start_timestamp, end_timestamp, etc.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $filters = $args['filter'] ?? [];

            $result = $this->service->listCalls($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
