<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

class RecurlyListPlans implements Tool
{
    /**
     * Create a new RecurlyListPlans tool instance.
     *
     * @param RecurlyService $service The Recurly API service.
     */
    public function __construct(
        private RecurlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'recurly_list_plans';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List billing plans from Recurly. Supports cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array The parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of plans to return (default: 20, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param array $args The tool arguments (limit, cursor).
     * @return ToolResult The result containing the list of plans or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
            }

            $result = $this->service->listPlans(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                cursor: $args['cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
