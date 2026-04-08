<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_list_calls
 *
 * List AI voice calls from Retell AI with optional filtering and pagination.
 *
 * @see https://docs.retellai.com/api-reference/list-calls
 */
class RetellListCalls implements Tool
{
    /**
     * Create a new RetellListCalls tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_list_calls';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'List AI voice calls from Retell. Supports filtering by criteria and cursor-based pagination using before/after timestamps.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of calls to return.'],
            'filter_criteria' => ['type' => 'object', 'description' => 'Filter criteria for calls. Supports filtering by agent_id, call_status, etc. Pass as a JSON object.'],
            'before' => ['type' => 'string', 'description' => 'Return calls created before this timestamp (ISO 8601 or Unix timestamp). Used for cursor-based pagination.'],
            'after' => ['type' => 'string', 'description' => 'Return calls created after this timestamp (ISO 8601 or Unix timestamp). Used for cursor-based pagination.'],
        ];
    }

    /**
     * Execute the list-calls tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $filterCriteria = null;
            if (isset($args['filter_criteria'])) {
                $filterCriteria = is_string($args['filter_criteria'])
                    ? json_decode($args['filter_criteria'], true)
                    : $args['filter_criteria'];
            }

            $result = $this->service->listCalls(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                filterCriteria: $filterCriteria,
                before: $args['before'] ?? null,
                after: $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
