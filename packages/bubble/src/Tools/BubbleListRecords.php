<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list records from a Bubble data type.
 *
 * Supports filtering via Bubble constraint objects, pagination with
 * limit and cursor, and returns matching records along with the
 * remaining count for pagination.
 */
class BubbleListRecords implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service instance.
     */
    public function __construct(
        private BubbleService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'bubble_list_records';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List records from a Bubble data type. Supports filtering with constraints, pagination with limit and cursor. Returns matching records and a remaining count for further pagination.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'The Bubble data type name (case-sensitive, e.g. "User", "Product", "Order").'],
            'constraints' => ['type' => 'string', 'description' => 'JSON-encoded array of Bubble constraint objects for filtering. Each constraint is {"key": "field_name", "constraint_type": "equals", "value": "some_value"}. Pass as a JSON string.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of records to return (1–100, default: 100).'],
            'cursor' => ['type' => 'integer', 'description' => 'Offset for pagination (0-based). Use the "remaining" count from the previous response to determine if more pages exist.'],
        ];
    }

    /**
     * Execute the list records tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            $constraints = [];
            if (isset($args['constraints'])) {
                $raw = $args['constraints'];
                $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
                if (is_array($decoded)) {
                    $constraints = $decoded;
                }
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $cursor = isset($args['cursor']) ? (int) $args['cursor'] : 0;

            $result = $this->service->listRecords($args['type'], $constraints, $limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
